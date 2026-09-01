<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefServerTable extends Migration
{
    public function up()
    {
        Schema::create('ref_server', function (Blueprint $table) {
            $table->id();
            $table->string('nama_server');
            $table->string('model_server');
            $table->integer('jml_host')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ref_server');
    }
}