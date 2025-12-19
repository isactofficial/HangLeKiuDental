<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsumableUsageDetail extends Model {
    protected $guarded = ['id'];
    public function transaction() {
        return $this->belongsTo(ConsumableTransaction::class);
    }
    public function consumable() {
        return $this->belongsTo(ConsumableUsage::class, 'consumable_id');
    }
}