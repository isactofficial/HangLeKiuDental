<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model {
    protected $guarded = ['id'];
    public function patient() {
        return $this->belongsTo(Patient::class, 'patient_id', 'user_id');
    }
    public function doctor() {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'user_id');
    }
    public function procedure() {
        return $this->belongsTo(Procedure::class);
    }
    public function queue() {
        return $this->hasOne(Queue::class);
    }
}