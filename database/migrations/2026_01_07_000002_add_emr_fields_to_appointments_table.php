<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('appointments', 'code')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->string('code')->nullable()->after('id');
            });
        }

        if (!Schema::hasColumn('appointments', 'medical_record_number')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->string('medical_record_number')->nullable()->after('patient_name');
            });
        }

        if (!Schema::hasColumn('appointments', 'patient_gender')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->string('patient_gender')->nullable()->after('medical_record_number');
            });
        }

        if (!Schema::hasColumn('appointments', 'patient_birth_date')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->date('patient_birth_date')->nullable()->after('patient_gender');
            });
        }

        if (!Schema::hasColumn('appointments', 'payment_method')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->string('payment_method')->nullable()->default('Langsung')->after('duration_minutes');
            });
        }
    }

    public function down(): void
    {
        $columnsToDrop = [];
        foreach (['code', 'medical_record_number', 'patient_gender', 'patient_birth_date', 'payment_method'] as $col) {
            if (Schema::hasColumn('appointments', $col)) {
                $columnsToDrop[] = $col;
            }
        }

        if (!empty($columnsToDrop)) {
            Schema::table('appointments', function (Blueprint $table) use ($columnsToDrop) {
                $table->dropColumn($columnsToDrop);
            });
        }
    }
};
