<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRefAlat extends Migration
{
    public function up()
    {
        Schema::create('ref_alat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_alat')->nullable();
            $table->string('tipe')->nullable();
            $table->string('model')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ref_alat');
    }
}