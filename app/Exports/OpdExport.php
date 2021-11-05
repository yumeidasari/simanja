<?php

namespace App\Exports;

use App\Models\RefOPD;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class OpdExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       $opd = DB::table('ref_opd')
						->select('ref_opd.nama_opd')
                        ->orderby('ref_opd.nama_opd','asc')
                        ->get();
		
		return $opd;
    }
	
	public function headings():array
	{
		return[
			'NAMA OPD',
		];
	}
}
