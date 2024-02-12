<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sampah_setor_sampah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sampah_id')->constrained('sampahs')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('setor_sampah_id')->constrained('setor_sampahs')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sampah_setor_sampah');
    }
};
