<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(){
        Schema::create('penyakits', function (Blueprint $t){
            $t->id();
            $t->string('kode');
            $t->string('nama');
            $t->text('deskripsi');
            $t->timestamps();
        });
    }
    public function down(){ Schema::dropIfExists('penyakits'); }
};
