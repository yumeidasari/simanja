<?php

namespace App\Exports;

use App\Models\Aplikasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class AplikasiExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Aplikasi::all();
		$aplikasi = DB::table('aplikasi')
						->join('ref_opd', 'aplikasi.id_opd', '=', 'ref_opd.id')
                        ->select('aplikasi.nama_aplikasi', 
								'ref_opd.nama_opd',
								'aplikasi.domain_url',
								'aplikasi.domain_ip',
								'aplikasi.link_repo'
								)
                        ->orderby('aplikasi.nama_aplikasi','asc')
                        ->get();
		
		return $aplikasi;
    }
	
	public function headings():array
	{
		return[
			'NAMA APLIKASI',
			'OPD PENGGUNA',
			'URL',
			'DOMAIN IP',
			'LINK REPO',
			
		];
	}
}
