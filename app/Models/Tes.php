<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tes extends Model
{
    use HasFactory;
	protected $table='ref_server';
	
	protected $fillable = ['nama_server', 'model_server', 'jml_host'];
	
}