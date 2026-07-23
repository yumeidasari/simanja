<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalAlatToRefOpd extends Migration
{
    public function up()
    {
        Schema::table('ref_opd', function (Blueprint $table) {
            $table->integer('total_alat')->nullable()->default(0);
        });
    }

    public function down()
    {
        Schema::table('ref_opd', function (Blueprint $table) {
            $table->dropColumn('total_alat');
        });
    }
}