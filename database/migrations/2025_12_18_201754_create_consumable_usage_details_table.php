<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consumable_usage_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('consumable_transactions');
            $table->foreignId('consumable_id')->constrained('consumable_usages');
            $table->integer('amount');
            $table->double('nominal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumable_usage_details');
    }
};
