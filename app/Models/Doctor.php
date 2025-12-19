<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model {
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $guarded = ['user_id'];
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function registrations() {
        return $this->hasMany(Registration::class, 'doctor_id', 'user_id');
    }
    public function medicalRecords() {
        return $this->hasMany(MedicalRecord::class, 'doctor_id', 'user_id');
    }
}
