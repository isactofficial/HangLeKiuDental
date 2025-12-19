<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model {
    protected $guarded = ['id'];
    public function doctor() {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'user_id');
    }
    public function patient() {
        return $this->belongsTo(Patient::class, 'patient_id', 'user_id');
    }
    public function procedure() {
        return $this->belongsTo(Procedure::class);
    }
}