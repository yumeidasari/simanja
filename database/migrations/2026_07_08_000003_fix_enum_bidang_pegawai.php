<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class FixEnumBidangPegawai extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE pegawai MODIFY bidang ENUM(
            'Sekretariat',
            'Bidang Aplikasi Informatika',
            'Bidang Informasi Dan Komunikasi Publik',
            'Bidang Keamanan Informasi, Persandian Dan Statistik'
        ) NOT NULL");
    }

    public function down()
    {
        //
    }
}