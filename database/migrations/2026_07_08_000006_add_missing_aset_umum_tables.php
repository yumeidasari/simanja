<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddMissingAsetUmumTables extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('lampiran_aset_kantor')) {
            Schema::create('lampiran_aset_kantor', function (Blueprint $table) {
                $table->id();
                $table->string('file_lampiran');
                $table->unsignedBigInteger('id_aset_kantor');
                $table->foreign('id_aset_kantor')->references('id')->on('aset_kantor');
                $table->unsignedBigInteger('createdBy')->nullable();
                $table->foreign('createdBy')->references('id')->on('users');
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->unsignedBigInteger('updatedBy')->nullable();
                $table->foreign('updatedBy')->references('id')->on('users');
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            });
        }

        if (!Schema::hasColumn('users', 'id_bidang')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('id_bidang')->nullable();
                $table->foreign('id_bidang')->references('id')->on('unit_kerja');
            });
        }
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'id_bidang')) {
                $table->dropForeign(['id_bidang']);
                $table->dropColumn('id_bidang');
            }
        });
        Schema::dropIfExists('lampiran_aset_kantor');
    }
}