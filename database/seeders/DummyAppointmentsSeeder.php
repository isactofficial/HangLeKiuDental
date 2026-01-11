<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\Doctor;
use Carbon\Carbon;

class DummyAppointmentsSeeder extends Seeder
{
    public function run(): void
    {
        $doctor = Doctor::where('name', 'drg. Dinda Tegar Jelita')->first();
        if (!$doctor) {
            $doctor = Doctor::create([
                'name' => 'drg. Dinda Tegar Jelita',
                'specialty' => 'Sp.Ortho',
                'practice_days' => [1, 3, 5],
                'practice_start_time' => '09:00',
                'practice_end_time' => '20:00',
            ]);
        } else {
            // Ensure the doctor is considered practicing at 18:40 (for demo parity)
            $doctor->practice_start_time = $doctor->practice_start_time ?: '09:00';
            $doctor->practice_end_time = $doctor->practice_end_time ?: '20:00';
            if ((string) $doctor->practice_end_time < '20:00') {
                $doctor->practice_end_time = '20:00';
            }
            $doctor->save();
        }

        $tz = config('app.timezone');
        $date = Carbon::now($tz)->toDateString();

        $startAt = Carbon::parse($date . ' 18:40:00', $tz);
        $endAt = $startAt->copy()->addMinutes(20);

        $createdAt = Carbon::parse($date . ' 02:21:00', $tz);

        $payload = [
            'code' => '0009RD',
            'patient_name' => 'Wild',
            'medical_record_number' => 'MR000003',
            'patient_gender' => 'Perempuan',
            // On 2026-01-07: 2002-03-17 -> 23 Tahun 9 Bulan 21 Hari
            'patient_birth_date' => '2002-03-17',
            'patient_phone' => '08xxxxxxxxxx',
            'doctor_id' => $doctor->id,
            'procedure' => 'Konsultasi Ortodonti',
            'duration_minutes' => 20,
            'payment_method' => 'Langsung',
            'start_at' => $startAt,
            'end_at' => $endAt,
            'status' => 'confirmed',
            'created_by_user_id' => null,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];

        // Upsert by code to keep seeding repeatable
        $appt = Appointment::where('code', '0009RD')->first();
        if ($appt) {
            $appt->fill($payload);
            $appt->save();
        } else {
            Appointment::create($payload);
        }
    }
}
