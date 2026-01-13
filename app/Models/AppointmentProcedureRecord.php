<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentProcedureRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'procedure_id',
        'name',
        'quantity',
        'selling_price',
        'discount_amount',
        'assistant_name',
        'note',
        'created_by_user_id',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'selling_price' => 'integer',
        'discount_amount' => 'integer',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function procedure()
    {
        return $this->belongsTo(Procedure::class);
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }
}
