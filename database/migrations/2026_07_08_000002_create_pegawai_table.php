<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('pegawai');

        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip', 20);
            $table->enum('bidang', ['Sekretariat', 'Aplikasi Informatika', 'Informasi dan Komunikasi Publik', 'Keamanan Informasi', 'Persandian', 'dan Statistik']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
}