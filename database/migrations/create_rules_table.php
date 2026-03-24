<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(){
        Schema::create('rules', function (Blueprint $t){
            $t->id();
            $t->foreignId('penyakit_id');
            $t->foreignId('gejala_id');
            $t->float('mb');
            $t->float('md');
            $t->timestamps();
        });
    }
    public function down(){ Schema::dropIfExists('rules'); }
};
