<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pasien');
            $table->json('gejala_terpilih'); // Menyimpan array gejala dan nilai CF user
            $table->unsignedBigInteger('penyakit_id')->nullable();
            $table->string('nama_penyakit');
            $table->float('persentase');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('riwayats');
    }
};