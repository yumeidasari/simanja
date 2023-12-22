<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAsetUmum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_kerja', function (Blueprint $table){
			$table->id();
			$table->string('nama_unit_kerja');
			$table->timestamps();
		});
		
		Schema::create('aset_kantor', function (Blueprint $table) {
            $table->id();
			$table->string('nama_aset');
			$table->string('penanggung_jawab');
			$table->string('nip')->nullable();
			$table->enum('kondisi_aset', ['baik', 'rusak ringan', 'rusak berat'])->default('baik');
			$table->enum('jenis_aset', ['kendaraan', 'elektronik'])->default('kendaraan');
			$table->string('merek');
			$table->text('deskripsi')->nullable();
			$table->unsignedBigInteger('id_unit_kerja');
			$table->foreign('id_unit_kerja')->references('id')->on('unit_kerja');
			$table->integer('thn_pengadaan')->nullable();
			
           // $table->timestamps();
			$table->unsignedBigInteger('createdBy');
            $table->foreign('createdBy')->references('id')->on('users');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('updatedBy')->nullable();
            $table->foreign('updatedBy')->references('id')->on('users');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));	
        });
		
		Schema::create('lampiran_aset_kantor', function (Blueprint $table){
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
		
		Schema::table('users', function (Blueprint $table){
			$table->unsignedBigInteger('id_bidang')->nullable();
			$table->foreign('id_bidang')->references('id')->on('unit_kerja');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lampiran_aset_kantor');
		Schema::dropIfExists('aset_kantor');
		Schema::dropIfExists('unit_kerja');
    }
}
