<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->time('practice_start_time')->nullable()->after('practice_days');
            $table->time('practice_end_time')->nullable()->after('practice_start_time');
        });
    }

    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn(['practice_start_time', 'practice_end_time']);
        });
    }
};
