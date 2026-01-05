<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Jobs\SendWhatsAppAppointmentReminder;

class BookingController extends Controller
{
    private const APPOINTMENT_DURATION_MINUTES = 20;

    /**
     * Normalize specialty strings so mapping is stable.
     */
    private function normalizeSpecialty(?string $specialty): string
    {
        $s = trim((string) $specialty);
        $s = preg_replace('/\s+/', ' ', $s);
        $s = preg_replace('/\s*\.\s*/', '.', $s);
        return Str::lower($s);
    }

    /**
     * Dummy tindakan per spesialisasi.
     */
    private function proceduresBySpecialty(): array
    {
        return [
            // orthodontics
            'sp.ortho' => [
                'Konsultasi Ortodonti',
                'Kontrol Behel',
                'Pemasangan Behel',
                'Lepas Behel',
            ],
            // conservative / general dentistry
            'sp.bm' => [
                'Konsultasi',
                'Scaling',
                'Tambal Gigi',
                'Pencabutan Gigi',
            ],
            // default
            '*' => [
                'Konsultasi',
                'Pemeriksaan',
            ],
        ];
    }

    /**
     * Practice window with dummy defaults when DB is empty.
     */
    private function getPracticeWindow(Doctor $doctor, Carbon $date): array
    {
        $practiceDays = is_array($doctor->practice_days) ? $doctor->practice_days : [];

        // If not configured, allow all days (dummy default)
        $enforceDays = !empty($practiceDays);
        if ($enforceDays) {
            $weekday = (int) $date->dayOfWeek; // 0-6
            if (!in_array($weekday, $practiceDays, true)) {
                return ['allowed' => false];
            }
        }

        $start = $doctor->practice_start_time ? substr((string) $doctor->practice_start_time, 0, 5) : '09:00';
        $end = $doctor->practice_end_time ? substr((string) $doctor->practice_end_time, 0, 5) : '17:00';

        $startAt = Carbon::parse($date->toDateString() . ' ' . $start, config('app.timezone'));
        $endAt = Carbon::parse($date->toDateString() . ' ' . $end, config('app.timezone'));

        return [
            'allowed' => true,
            'startAt' => $startAt,
            'endAt' => $endAt,
            'start' => $start,
            'end' => $end,
            'practiceDays' => $practiceDays,
        ];
    }

    // show public booking form (accept prefill via query)
    public function create(Request $request)
    {
        $doctors = Doctor::all();
        $prefill = [
            'doctor_id' => $request->query('doctor_id', $request->query('doctor')),
            'date' => $request->query('date'),
            'start_time' => $request->query('start_time', $request->query('start')),
            'end_time' => $request->query('end_time', $request->query('end')),
        ];

        $proceduresBySpecialty = $this->proceduresBySpecialty();
        $durationMinutes = self::APPOINTMENT_DURATION_MINUTES;

        return view('booking.create', compact('doctors','prefill','proceduresBySpecialty','durationMinutes'));
    }

    // API: get available slots for doctor/date
    public function slots(Request $request)
    {
        $v = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date',
        ]);
        if ($v->fails()) {
            return response()->json(['error' => 'Invalid request', 'details' => $v->errors()], 422);
        }

        $doctor = Doctor::findOrFail($request->doctor_id);
        $date = Carbon::parse($request->date, config('app.timezone'));

        $window = $this->getPracticeWindow($doctor, $date);
        if (empty($window['allowed'])) {
            return response()->json(['slots' => [], 'error' => 'Dokter tidak praktek pada hari yang dipilih'], 200);
        }

        $practiceStart = $window['startAt'];
        $practiceEnd = $window['endAt'];
        $duration = self::APPOINTMENT_DURATION_MINUTES;

        $existing = Appointment::where('doctor_id', $doctor->id)
            ->whereDate('start_at', $date->toDateString())
            ->get(['start_at', 'end_at']);

        $slots = [];
        $cursor = $practiceStart->copy();
        $lastStart = $practiceEnd->copy()->subMinutes($duration);

        while ($cursor->lte($lastStart)) {
            $slotStart = $cursor->copy();
            $slotEnd = $cursor->copy()->addMinutes($duration);

            $overlap = $existing->contains(function ($a) use ($slotStart, $slotEnd) {
                return $a->start_at->lt($slotEnd) && $a->end_at->gt($slotStart);
            });

            if (!$overlap) {
                $slots[] = $slotStart->format('H:i');
            }

            $cursor->addMinutes($duration);
        }

        return response()->json([
            'slots' => $slots,
            'duration_minutes' => $duration,
            'practice' => [
                'start' => $window['start'],
                'end' => $window['end'],
            ],
        ]);
    }

    // store booking (patient self-service)
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'patient_name' => 'required|string|max:255',
            'patient_phone' => 'required|string|max:30',
            'doctor_id' => 'required|exists:doctors,id',
            'procedure' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required',
        ]);

        if($v->fails()) return back()->withErrors($v)->withInput();

        $doctor = Doctor::find($request->doctor_id);
        $date = $request->date; // YYYY-MM-DD
        $startAt = Carbon::parse($date.' '.$request->start_time, config('app.timezone'));
        $endAt = $startAt->copy()->addMinutes(self::APPOINTMENT_DURATION_MINUTES);

        $window = $this->getPracticeWindow($doctor, Carbon::parse($date, config('app.timezone')));
        if (empty($window['allowed'])) {
            if ($request->wantsJson()) return response()->json(['error' => 'Dokter tidak praktek pada hari yang dipilih'], 422);
            return back()->withErrors(['doctor_id' => 'Dokter tidak praktek pada hari yang dipilih'])->withInput();
        }

        $practiceStart = $window['startAt'];
        $practiceEnd = $window['endAt'];
        if ($startAt->lt($practiceStart) || $endAt->gt($practiceEnd)) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Jam booking di luar jam praktek dokter'], 422);
            }
            return back()->withErrors(['time' => 'Jam booking di luar jam praktek dokter'])->withInput();
        }

        // validate procedure is allowed for doctor specialty (dummy mapping)
        $map = $this->proceduresBySpecialty();
        $normalized = $this->normalizeSpecialty($doctor->specialty);
        $allowed = $map[$normalized] ?? $map['*'];
        if (!in_array($request->procedure, $allowed, true)) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Tindakan tidak sesuai spesialisasi dokter'], 422);
            }
            return back()->withErrors(['procedure' => 'Tindakan tidak sesuai spesialisasi dokter'])->withInput();
        }

        // check overlapping appointments for same doctor (start < existing.end AND end > existing.start)
        $overlap = Appointment::where('doctor_id', $doctor->id)
            ->where('start_at', '<', $endAt)
            ->where('end_at', '>', $startAt)
            ->exists();

        if($overlap){
            if($request->wantsJson()) return response()->json(['error'=>'Waktu bertabrakan dengan janji lain'], 422);
            return back()->withErrors(['time' => 'Waktu bertabrakan dengan janji lain'])->withInput();
        }

        // create within transaction to reduce race conditions
        $appt = null;
        \DB::transaction(function() use (&$appt, $request, $doctor, $startAt, $endAt){
            $appt = Appointment::create([
                'patient_name' => $request->patient_name,
                'patient_phone' => $request->patient_phone,
                'doctor_id' => $doctor->id,
                'procedure' => $request->procedure,
                'duration_minutes' => self::APPOINTMENT_DURATION_MINUTES,
                'start_at' => $startAt,
                'end_at' => $endAt,
                'status' => 'confirmed',
            ]);
        });

        // schedule WA reminder 10 minutes before end (i.e. start + 10 for 20-minute actions)
        $remindAt = $endAt->copy()->subMinutes(10);
        SendWhatsAppAppointmentReminder::dispatch($appt->id)->delay($remindAt);

        if($request->wantsJson()){
            return response()->json(['success' => true, 'appointment' => [
                'id'=>$appt->id,
                'doctor_id'=>$appt->doctor_id,
                'start_at'=>$appt->start_at->toDateTimeString(),
                'end_at'=>$appt->end_at->toDateTimeString(),
            ]], 201);
        }

        return redirect()->route('rawat.jalan')->with('success','Booking berhasil');
    }

    // API: get appointments for date (YYYY-MM-DD)
    public function index(Request $request)
    {
        $date = $request->query('date');
        if(!$date) $date = now()->toDateString();
        $start = \Carbon\Carbon::parse($date.' 00:00:00');
        $end = \Carbon\Carbon::parse($date.' 23:59:59');

        $appointments = Appointment::with('doctor')
            ->whereBetween('start_at', [$start, $end])
            ->get()
            ->map(function($a){
                return [
                    'id' => $a->id,
                    'patient_name' => $a->patient_name,
                    'doctor_id' => $a->doctor_id,
                    'doctor_name' => $a->doctor->name ?? null,
                    'start_at' => $a->start_at->toDateTimeString(),
                    'end_at' => $a->end_at->toDateTimeString(),
                    'status' => $a->status,
                ];
            });

        return response()->json($appointments);
    }
}
