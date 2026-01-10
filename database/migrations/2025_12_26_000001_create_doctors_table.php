<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('specialty')->nullable();
            $table->json('practice_days')->nullable();
            $table->timestamps();
        });

        // seed some example doctors
        DB::table('doctors')->insert([
            ['name' => 'drg. Dinda Tegar Jelita', 'specialty' => 'Sp.Ortho', 'practice_days' => json_encode([1,3,5]), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'drg. Ria Budiati', 'specialty' => 'Sp. Ortho', 'practice_days' => json_encode([2,4]), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'drg. Wenny Yulvie', 'specialty' => 'Sp.BM', 'practice_days' => json_encode([1,2,3,4,5]), 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('doctors');
    }
};
