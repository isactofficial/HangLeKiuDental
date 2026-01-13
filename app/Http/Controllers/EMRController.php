<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\AppointmentDiagnosis;
use App\Models\AppointmentDoctorNote;
use App\Models\AppointmentProcedureRecord;
use App\Models\AppointmentOdontogram;
use App\Models\Procedure;
use Illuminate\Http\Request;

class EMRController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $query = Appointment::with([
            'doctor',
            'createdByUser',
            'diagnoses.createdByUser',
            'doctorNotes.createdByUser',
            'procedureRecords.createdByUser',
            'odontograms.createdByUser',
        ])
            ->orderBy('start_at', 'desc');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('patient_name', 'like', "%{$search}%")
                  ->orWhere('medical_record_number', 'like', "%{$search}%")
                  ->orWhere('patient_phone', 'like', "%{$search}%");
            });
        }

        if ($status && $status !== 'Semua') {
            $query->where('status', $status);
        }

        $appointments = $query->get();
        $patients = $appointments->groupBy(function($appointment) {
            return $appointment->medical_record_number ?: $appointment->patient_name;
        })->map(function($group) {
            $latestAppointment = $group->sortByDesc('start_at')->first();

            return [
                'id' => md5($latestAppointment->medical_record_number ?: $latestAppointment->patient_name),
                'name' => $latestAppointment->patient_name,
                'medical_record_number' => $latestAppointment->medical_record_number,
                'gender' => $latestAppointment->patient_gender,
                'birth_date' => $latestAppointment->patient_birth_date,
                'phone' => $latestAppointment->patient_phone,
                'latest_appointment' => $latestAppointment,
                'appointments' => $group->sortByDesc('start_at')->values()
            ];
        })->values();

        $procedures = Procedure::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('emr', compact('patients', 'procedures'));
    }

    public function show($patientId)
    {
        $appointments = Appointment::with([
                'doctor',
                'createdByUser',
                'diagnoses.createdByUser',
                'doctorNotes.createdByUser',
                'procedureRecords.createdByUser',
                'odontograms.createdByUser',
            ])
            ->orderBy('start_at', 'desc')
            ->get();

        $patient = null;
        foreach ($appointments->groupBy(function($appointment) {
            return $appointment->medical_record_number ?: $appointment->patient_name;
        }) as $key => $group) {
            $hashedId = md5($key);
            if ($hashedId === $patientId) {
                $latestAppointment = $group->sortByDesc('start_at')->first();
                $patient = [
                    'id' => $hashedId,
                    'name' => $latestAppointment->patient_name,
                    'medical_record_number' => $latestAppointment->medical_record_number,
                    'gender' => $latestAppointment->patient_gender,
                    'birth_date' => $latestAppointment->patient_birth_date,
                    'phone' => $latestAppointment->patient_phone,
                    'appointments' => $group->sortByDesc('start_at')->values()
                ];
                break;
            }
        }

        if (!$patient) {
            abort(404);
        }

        return response()->json($patient);
    }

    public function update(Request $request, $patientId)
    {
        $validated = $request->validate([
            'patient_name' => 'required|string|max:255',
            'patient_gender' => 'nullable|string|max:20',
            'patient_birth_date' => 'nullable|date',
            'patient_phone' => 'nullable|string|max:255',
            'medical_record_number' => 'nullable|string|max:255'
        ]);

        $appointments = Appointment::where('medical_record_number', $validated['medical_record_number'])
            ->orWhere(function($q) use ($validated) {
                $q->where('patient_name', $validated['patient_name'])
                  ->whereNull('medical_record_number');
            })
            ->get();

        foreach ($appointments as $appointment) {
            $appointment->update($validated);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data pasien berhasil diperbarui'
        ]);
    }

    public function storeDiagnosis(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'note' => 'nullable|string',
        ]);

        $diagnosis = AppointmentDiagnosis::create([
            'appointment_id' => $appointment->id,
            'name' => $validated['name'],
            'note' => $validated['note'] ?? null,
            'created_by_user_id' => $request->user()?->id,
        ]);

        return response()->json(['success' => true, 'diagnosis' => $diagnosis], 201);
    }

    public function storeDoctorNote(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'note' => 'required|string',
        ]);

        $note = AppointmentDoctorNote::create([
            'appointment_id' => $appointment->id,
            'note' => $validated['note'],
            'created_by_user_id' => $request->user()?->id,
        ]);

        return response()->json(['success' => true, 'note' => $note], 201);
    }

    public function storeProcedureRecord(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'procedure_id' => 'nullable|integer|exists:procedures,id',
            'name' => 'required_without:procedure_id|string|max:255',
            'note' => 'nullable|string',
            'quantity' => 'nullable|integer|min:1',
            'selling_price' => 'nullable|integer|min:0',
            'discount_amount' => 'nullable|integer|min:0',
            'assistant_name' => 'nullable|string|max:255',
        ]);

        $catalog = null;
        if (!empty($validated['procedure_id'])) {
            $catalog = Procedure::find($validated['procedure_id']);
        }

        $name = $validated['name'] ?? ($catalog?->name);
        $sellingPrice = array_key_exists('selling_price', $validated) ? $validated['selling_price'] : null;
        if (is_null($sellingPrice) && $catalog) {
            $sellingPrice = $catalog->price;
        }

        $proc = AppointmentProcedureRecord::create([
            'appointment_id' => $appointment->id,
            'procedure_id' => $catalog?->id,
            'name' => $name,
            'quantity' => $validated['quantity'] ?? 1,
            'selling_price' => $sellingPrice,
            'discount_amount' => $validated['discount_amount'] ?? 0,
            'assistant_name' => $validated['assistant_name'] ?? null,
            'note' => $validated['note'] ?? null,
            'created_by_user_id' => $request->user()?->id,
        ]);

        return response()->json(['success' => true, 'procedure' => $proc], 201);
    }

    public function storeOdontogram(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'summary' => 'nullable|string|max:255',
            'data' => 'nullable',
        ]);

        $data = $validated['data'] ?? null;
        if (is_string($data) && trim($data) !== '') {
            $decoded = json_decode($data, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return response()->json(['success' => false, 'message' => 'Data odontogram harus JSON valid'], 422);
            }
            $data = $decoded;
        }

        $odo = AppointmentOdontogram::create([
            'appointment_id' => $appointment->id,
            'summary' => $validated['summary'] ?? null,
            'data' => $data,
            'created_by_user_id' => $request->user()?->id,
        ]);

        return response()->json(['success' => true, 'odontogram' => $odo], 201);
    }
}
