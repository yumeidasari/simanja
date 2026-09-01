<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVirtualMachineTable extends Migration
{
    public function up()
    {
        Schema::create('virtual_machine', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_alat')->nullable();
            $table->foreign('id_alat')->references('id')->on('ref_alat');
            $table->string('nama_vm');
            $table->string('ip_vm');
            $table->string('os_vm');
            $table->string('server_vm');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('virtual_machine');
    }
}