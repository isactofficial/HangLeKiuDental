<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentOdontogram extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'summary',
        'data',
        'created_by_user_id',
    ];

    protected $casts = [
        'data' => 'array',
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
