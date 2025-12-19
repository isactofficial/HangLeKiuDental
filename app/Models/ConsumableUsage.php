<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsumableUsage extends Model {
    protected $guarded = ['id'];
    public function details() {
        return $this->hasMany(ConsumableUsageDetail::class, 'consumable_id');
    }
}
