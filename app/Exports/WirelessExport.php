<?php

namespace App\Exports;

use App\Models\Wireless;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class WirelessExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Wireless::all();
		$semua_wireless = DB::table('wireless')
						->join('ref_opd', 'wireless.id_opd', '=', 'ref_opd.id')
                        ->select('ref_opd.nama_opd',
								'wireless.ip_router', 
								'wireless.ip_client')
						->orderby('ref_opd.nama_opd','asc')
                        ->get();
		
		return $semua_wireless;
    }
	
	public function headings():array
	{
		return[
			'NAMA OPD',
			'IP ROUTER',
			'IP CLIENT',
			
		];
	}
}
