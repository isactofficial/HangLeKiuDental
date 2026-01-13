<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;

class Appointment extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::created(function (self $appointment) {
            $didChange = false;

            // Booking Code (formerly No. RM in UI)
            if (empty($appointment->medical_record_number)) {
                $appointment->medical_record_number = 'BK' . str_pad((string) $appointment->id, 6, '0', STR_PAD_LEFT);
                $didChange = true;
            }

            // Public-facing short code used in rawat jalan detail
            if (empty($appointment->code)) {
                $seed = ((int) $appointment->id * 97) + ((int) ($appointment->doctor_id ?? 0) * 13) + 12345;
                $base36 = strtoupper(base_convert((string) $seed, 10, 36));
                $appointment->code = Str::of(str_pad($base36, 6, '0', STR_PAD_LEFT))->substr(0, 6)->toString();
                $didChange = true;
            }

            if ($didChange) {
                $appointment->saveQuietly();
            }
        });
    }

    protected $fillable = [
        'code',
        'patient_name',
        'medical_record_number',
        'patient_gender',
        'patient_birth_date',
        'patient_phone',
        'doctor_id',
        'procedure',
        'duration_minutes',
        'payment_method',
        'start_at',
        'end_at',
        'status',
        'created_by_user_id',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'patient_birth_date' => 'date',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function diagnoses()
    {
        return $this->hasMany(AppointmentDiagnosis::class);
    }

    public function doctorNotes()
    {
        return $this->hasMany(AppointmentDoctorNote::class);
    }

    public function procedureRecords()
    {
        return $this->hasMany(AppointmentProcedureRecord::class);
    }

    public function odontograms()
    {
        return $this->hasMany(AppointmentOdontogram::class);
    }
}
