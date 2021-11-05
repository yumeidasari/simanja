<?php

namespace App\Exports;

use App\Models\JaringanOpd;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class JaringanOpdExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return JaringanOpd::all();
		$semua_jaringan = DB::table('jaringan_opd')
						->join('ref_opd', 'jaringan_opd.id_opd', '=', 'ref_opd.id')
						->join('ref_alat', 'jaringan_opd.id_alat', '=', 'ref_alat.id')
                        ->select(	'ref_opd.nama_opd',
									'ref_alat.nama_alat', 
									'ref_alat.tipe',
									'ref_alat.model',
									'jaringan_opd.kode_alat',
									'jaringan_opd.kondisi')
                        ->orderby('jaringan_opd.id','desc')
                        ->get();
						
		return $semua_jaringan;
    }
	
	public function headings():array
	{
		return[
			'NAMA OPD',
			'NAMA ALAT',
			'TIPE ALAT',
			'MODEL ALAT',
			'KODE ALAT',
			'KONDISI',
			
		];
	}
}
