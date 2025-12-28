<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['name','specialty','practice_days']; // practice_days stored as JSON array of weekday numbers 0(Sun)-6(Sat)

    protected $casts = [
        'practice_days' => 'array',
    ];
}
