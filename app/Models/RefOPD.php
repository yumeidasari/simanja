<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class RefOPD extends Model
{
    use HasFactory;
	use Sortable;
	
	protected $table='ref_opd';
	
	protected $fillable = ['nama_opd'];
	
	public $sortable = ['nama_opd'];
	
	public static function getOpd()
	{
		$records = DB::table('ref_opd')->select('id','nama_opd');
		return $records;
	}
}
