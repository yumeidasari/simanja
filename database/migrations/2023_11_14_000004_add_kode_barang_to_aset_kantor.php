<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKodeBarangToAsetKantor extends Migration
{
    public function up()
    {
        Schema::table('aset_kantor', function (Blueprint $table) {
            $table->string('kode_barang')->nullable()->after('nama_aset');
        });
    }

    public function down()
    {
        Schema::table('aset_kantor', function (Blueprint $table) {
            $table->dropColumn('kode_barang');
        });
    }
}