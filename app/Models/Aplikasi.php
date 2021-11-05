<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Aplikasi extends Model
{
    use HasFactory;
	use Sortable;
	
	protected $table='aplikasi';
	
	protected $fillable = ['nama_aplikasi', 'id_opd', 'letak_server', 'link_repo', 
							'domain_url', 'domain_ip', 'jenis_layanan', 'fungsi', 'platform',
							'versi', 'pengembang', 'bhs_pemrograman' ];
							
	public $sortable = ['nama_aplikasi', 'id_opd', 'domain_url', 'domain_ip', 'link_repo'];
	
	public function opd()
    {
        return $this->belongsTo('App\Models\RefOPD', 'id_opd');
    }
}
