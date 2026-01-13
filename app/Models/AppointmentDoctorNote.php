<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentDoctorNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'note',
        'created_by_user_id',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }
}
