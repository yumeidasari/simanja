<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Vm extends Model
{
    use HasFactory;
	use Sortable;
	
	protected $table='virtual_machine';
	
	protected $fillable = ['id_alat', 'nama_vm', 'ip_vm', 'os_vm', 'server_vm'];
	
	public $sortable = ['nama_vm'];
	
	public function alat()
    {
        return $this->belongsTo('App\Models\RefAlat', 'id_alat');
    }
}
