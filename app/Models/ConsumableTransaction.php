<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsumableTransaction extends Model {
    protected $guarded = ['id'];
    public function details() {
        return $this->hasMany(ConsumableUsageDetail::class, 'transaction_id');
    }
}
