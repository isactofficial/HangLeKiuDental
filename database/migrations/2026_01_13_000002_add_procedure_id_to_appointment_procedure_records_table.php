<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('appointment_procedure_records')) {
            return;
        }

        Schema::table('appointment_procedure_records', function (Blueprint $table) {
            if (!Schema::hasColumn('appointment_procedure_records', 'procedure_id')) {
                $table->foreignId('procedure_id')
                    ->nullable()
                    ->after('appointment_id')
                    ->constrained('procedures')
                    ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('appointment_procedure_records')) {
            return;
        }

        if (!Schema::hasColumn('appointment_procedure_records', 'procedure_id')) {
            return;
        }

        Schema::table('appointment_procedure_records', function (Blueprint $table) {
            $table->dropConstrainedForeignId('procedure_id');
        });
    }
};
