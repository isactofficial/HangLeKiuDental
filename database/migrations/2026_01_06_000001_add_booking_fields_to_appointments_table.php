<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('patient_phone')->nullable()->after('patient_name');
            $table->string('procedure')->nullable()->after('doctor_id');
            $table->unsignedSmallInteger('duration_minutes')->default(20)->after('procedure');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['patient_phone', 'procedure', 'duration_minutes']);
        });
    }
};
