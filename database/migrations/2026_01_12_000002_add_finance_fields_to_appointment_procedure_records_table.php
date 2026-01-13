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
            if (!Schema::hasColumn('appointment_procedure_records', 'quantity')) {
                $table->unsignedInteger('quantity')->default(1)->after('name');
            }

            if (!Schema::hasColumn('appointment_procedure_records', 'selling_price')) {
                $table->unsignedBigInteger('selling_price')->nullable()->after('quantity');
            }

            if (!Schema::hasColumn('appointment_procedure_records', 'discount_amount')) {
                $table->unsignedBigInteger('discount_amount')->default(0)->after('selling_price');
            }

            if (!Schema::hasColumn('appointment_procedure_records', 'assistant_name')) {
                $table->string('assistant_name')->nullable()->after('discount_amount');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('appointment_procedure_records')) {
            return;
        }

        Schema::table('appointment_procedure_records', function (Blueprint $table) {
            $columns = [];
            foreach (['quantity', 'selling_price', 'discount_amount', 'assistant_name'] as $col) {
                if (Schema::hasColumn('appointment_procedure_records', $col)) {
                    $columns[] = $col;
                }
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};
