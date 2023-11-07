<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableVirtualMachine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('virtual_machine', function (Blueprint $table) {
            
			$table->unsignedInteger('id_alat')->nullable()->after('id');
            $table->foreign('id_alat')->references('id')->on('ref_alat');
			
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('virtual_machine', function (Blueprint $table) {
            $table->dropForeign('virtual_machine_id_alat_foreign');
            $table->dropColumn('id_alat');
            
           
        });
    }
}
