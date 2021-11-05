<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class JaringanOpd extends Model
{
    use HasFactory;
	use Sortable;
	
	protected $table='jaringan_opd';
	
	protected $fillable = ['id_opd', 'id_alat', 'kondisi', 'kode_alat', 'tgl_pemasangan', 'foto'];
	
	public $sortable = ['id_opd', 'id_alat',  'kode_alat', 'kondisi'];
	
	public function opd()
    {
        return $this->belongsTo('App\Models\RefOPD', 'id_opd');
    }
	
	public function alat()
    {
        return $this->belongsTo('App\Models\RefAlat', 'id_alat');
    }
}
