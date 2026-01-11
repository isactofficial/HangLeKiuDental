<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class EMRController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $query = Appointment::with(['doctor', 'createdByUser'])
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

        return view('emr', compact('patients'));
    }

    public function show($patientId)
    {
        $appointments = Appointment::with(['doctor', 'createdByUser'])
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
}
