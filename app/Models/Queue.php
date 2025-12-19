<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model {
    protected $guarded = ['id'];
    public function registration() {
        return $this->belongsTo(Registration::class);
    }
}
