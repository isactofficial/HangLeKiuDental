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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients', 'user_id');
            $table->foreignId('doctor_id')->constrained('doctors', 'user_id');
            $table->foreignId('procedure_id')->constrained('procedures');
            $table->dateTime('expected_start_time')->nullable();
            $table->dateTime('expected_end_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
