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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors', 'user_id');
            $table->foreignId('patient_id')->constrained('patients', 'user_id');
            $table->foreignId('procedure_id')->constrained('procedures')->onDelete('cascade');
            $table->date('registration_date');
            $table->date('recorded_date')->nullable();
            $table->text('doctor_note')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
