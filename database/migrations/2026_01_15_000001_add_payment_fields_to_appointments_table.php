<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            if (!Schema::hasColumn('appointments', 'payment_status')) {
                $table->string('payment_status')->default('unpaid')->after('payment_method');
            }
            if (!Schema::hasColumn('appointments', 'paid_at')) {
                $table->dateTime('paid_at')->nullable()->after('payment_status');
            }
            if (!Schema::hasColumn('appointments', 'paid_amount')) {
                $table->unsignedBigInteger('paid_amount')->default(0)->after('paid_at');
            }
            if (!Schema::hasColumn('appointments', 'paid_by')) {
                $table->string('paid_by')->nullable()->after('paid_amount');
            }
            if (!Schema::hasColumn('appointments', 'change_amount')) {
                $table->unsignedBigInteger('change_amount')->default(0)->after('paid_by');
            }
            if (!Schema::hasColumn('appointments', 'outstanding_amount')) {
                $table->unsignedBigInteger('outstanding_amount')->default(0)->after('change_amount');
            }
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $columns = [];
            foreach (['payment_status', 'paid_at', 'paid_amount', 'paid_by', 'change_amount', 'outstanding_amount'] as $col) {
                if (Schema::hasColumn('appointments', $col)) {
                    $columns[] = $col;
                }
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};
