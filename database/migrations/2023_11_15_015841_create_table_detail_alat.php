<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDetailAlat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('ref_alat', function (Blueprint $table) {
			$table->id()->change();
		});
		
        Schema::create('detail_alat', function (Blueprint $table) {
            $table->id();
			$table->decimal('harga',15,2)->nullable();
			$table->integer('jumlah')->nullable();
			$table->unsignedBigInteger('id_alat');
			$table->foreign('id_alat')->references('id')->on('ref_alat');
			$table->date('tgl_pengadaan');
            //$table->timestamps();
			$table->unsignedBigInteger('createdBy');
            $table->foreign('createdBy')->references('id')->on('users');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('updatedBy')->nullable();
            $table->foreign('updatedBy')->references('id')->on('users');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));	
        });
		
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
        Schema::dropIfExists('detail_alat');
    }
}
