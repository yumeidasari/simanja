<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tes extends Model
{
    use HasFactory;
	protected $table='tes';
	
	protected $fillable = ['id_opd', 'ip_client', 'ip_router', 'keterangan'];
	
	public function opd()
    {
        return $this->belongsTo('App\Models\RefOPD', 'id_opd');
    }
}
