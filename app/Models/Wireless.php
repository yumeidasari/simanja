<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Wireless extends Model
{
    use HasFactory;
	protected $table='wireless';
	
	protected $fillable = ['id_opd', 'ip_client', 'ip_router', 'keterangan'];
	
	public static function getWireless()
	{
		$records = DB::table('wireless')->select('id','id_opd', 'ip_client', 'ip_router', 'keterangan');
		return $records;
	}
	
	public function opd()
    {
        return $this->belongsTo('App\Models\RefOPD', 'id_opd');
    }
	
}
