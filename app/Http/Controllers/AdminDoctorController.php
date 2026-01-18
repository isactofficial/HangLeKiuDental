<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminDoctorController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'specialty' => ['nullable', 'string', 'max:255'],
            'practice_days' => ['nullable', 'array'],
            'practice_days.*' => ['integer', 'min:0', 'max:6'],
            'practice_start_time' => ['nullable', 'date_format:H:i'],
            'practice_end_time' => ['nullable', 'date_format:H:i'],
        ]);

        $this->validatePracticeHours($data);

        Doctor::create([
            'name' => $data['name'],
            'specialty' => $data['specialty'] ?? null,
            'practice_days' => $data['practice_days'] ?? [],
            'practice_start_time' => $data['practice_start_time'] ?? null,
            'practice_end_time' => $data['practice_end_time'] ?? null,
        ]);

        return back()->with('status', 'Dokter berhasil ditambahkan.');
    }

    public function update(Request $request, Doctor $doctor)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'specialty' => ['nullable', 'string', 'max:255'],
            'practice_days' => ['nullable', 'array'],
            'practice_days.*' => ['integer', 'min:0', 'max:6'],
            'practice_start_time' => ['nullable', 'date_format:H:i'],
            'practice_end_time' => ['nullable', 'date_format:H:i'],
        ]);

        $this->validatePracticeHours($data);

        $doctor->update([
            'name' => $data['name'],
            'specialty' => $data['specialty'] ?? null,
            'practice_days' => $data['practice_days'] ?? [],
            'practice_start_time' => $data['practice_start_time'] ?? null,
            'practice_end_time' => $data['practice_end_time'] ?? null,
        ]);

        return back()->with('status', 'Jadwal dokter berhasil diperbarui.');
    }

    private function validatePracticeHours(array $data): void
    {
        $start = $data['practice_start_time'] ?? null;
        $end = $data['practice_end_time'] ?? null;

        if (($start && !$end) || (!$start && $end)) {
            throw ValidationException::withMessages([
                'practice_end_time' => 'Jam praktek harus diisi lengkap (mulai dan selesai).',
            ]);
        }

        if ($start && $end && strcmp($end, $start) <= 0) {
            throw ValidationException::withMessages([
                'practice_end_time' => 'Jam selesai harus lebih besar dari jam mulai.',
            ]);
        }
    }
}
