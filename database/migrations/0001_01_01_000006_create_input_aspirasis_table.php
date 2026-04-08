<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('input_aspirasis', function (Blueprint $table) {
            $table->increments('id_pelaporan');
            $table->char('nis', 10);
            $table->unsignedInteger('id_kategori');
            $table->string('lokasi', 50);
            $table->string('ket', 50);
            $table->timestamps();

            $table->foreign('nis')->references('nis')->on('siswas')->cascadeOnDelete();
            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('input_aspirasis');
    }
};
