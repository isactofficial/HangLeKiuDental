<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model {
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $guarded = ['user_id'];
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function registrations() {
        return $this->hasMany(Registration::class, 'patient_id', 'user_id');
    }
    public function medicalRecords() {
        return $this->hasMany(MedicalRecord::class, 'patient_id', 'user_id');
    }
}