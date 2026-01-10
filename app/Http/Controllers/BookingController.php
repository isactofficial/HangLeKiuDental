<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
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
        return view('booking.create', compact('doctors','prefill'));
    }

    // store booking (patient self-service)
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'patient_name' => 'required|string|max:255',
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        if($v->fails()) return back()->withErrors($v)->withInput();

        $doctor = Doctor::find($request->doctor_id);
        $date = $request->date; // YYYY-MM-DD
        $startAt = \Carbon\Carbon::parse($date.' '.$request->start_time, config('app.timezone'));
        $endAt = \Carbon\Carbon::parse($date.' '.$request->end_time, config('app.timezone'));

        // check practice day
        $weekday = (int)$startAt->dayOfWeek; // 0-6
        if(!$doctor->practice_days || !in_array($weekday, $doctor->practice_days)){
            if($request->wantsJson()) return response()->json(['error'=>'Dokter tidak praktek pada hari yang dipilih'], 422);
            return back()->withErrors(['doctor_id' => 'Dokter tidak praktek pada hari yang dipilih'])->withInput();
        }

        // check practice hours (if configured)
        if ($doctor->practice_start_time && $doctor->practice_end_time) {
            $practiceStart = \Carbon\Carbon::parse($date . ' ' . $doctor->practice_start_time, config('app.timezone'));
            $practiceEnd = \Carbon\Carbon::parse($date . ' ' . $doctor->practice_end_time, config('app.timezone'));

            if ($startAt->lt($practiceStart) || $endAt->gt($practiceEnd)) {
                if ($request->wantsJson()) {
                    return response()->json(['error' => 'Jam booking di luar jam praktek dokter'], 422);
                }
                return back()->withErrors(['time' => 'Jam booking di luar jam praktek dokter'])->withInput();
            }
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
                'doctor_id' => $doctor->id,
                'start_at' => $startAt,
                'end_at' => $endAt,
                'status' => 'confirmed',
            ]);
        });

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
