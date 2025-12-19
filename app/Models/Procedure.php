<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model {
    protected $guarded = ['id'];
    public function registrations() {
        return $this->hasMany(Registration::class);
    }
}
