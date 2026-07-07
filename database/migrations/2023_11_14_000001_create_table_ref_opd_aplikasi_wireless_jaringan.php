<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRefOpdAplikasiWirelessJaringan extends Migration
{
    public function up()
    {
        Schema::create('ref_opd', function (Blueprint $table) {
            $table->id();
            $table->string('nama_opd')->nullable();
            $table->timestamps();
        });

        Schema::create('aplikasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_aplikasi')->nullable();
            $table->unsignedBigInteger('id_opd')->nullable();
            $table->string('letak_server')->nullable();
            $table->string('link_repo')->nullable();
            $table->string('domain_url')->nullable();
            $table->string('domain_ip')->nullable();
            $table->string('jenis_layanan')->nullable();
            $table->string('fungsi')->nullable();
            $table->string('platform')->nullable();
            $table->string('versi')->nullable();
            $table->string('pengembang')->nullable();
            $table->string('bhs_pemrograman')->nullable();
            $table->timestamps();
        });

        Schema::create('wireless', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_opd')->nullable();
            $table->string('ip_client')->nullable();
            $table->string('ip_router')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('jaringan_opd', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_opd')->nullable();
            $table->unsignedBigInteger('id_alat')->nullable();
            $table->string('kondisi')->nullable();
            $table->string('kode_alat')->nullable();
            $table->date('tgl_pemasangan')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jaringan_opd');
        Schema::dropIfExists('wireless');
        Schema::dropIfExists('aplikasi');
        Schema::dropIfExists('ref_opd');
    }
}