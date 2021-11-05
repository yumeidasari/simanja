<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class RefAlat extends Model
{
    use HasFactory;
	use Sortable;
	
	protected $table='ref_alat';
	
	protected $fillable = ['nama_alat', 'tipe', 'model'];
	
	public $sortable = ['nama_alat', 'tipe', 'model'];
}
