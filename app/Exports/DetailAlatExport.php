<?php

namespace App\Exports;

use App\Models\DetailAlat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DetailAlatExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DetailAlat::all();
    }
	
	public function headings():array
	{
		return[
			'ID',
			'HARGA',
			'JUMLAH',
			'',
			'TGL PENGADAAN',
			
		];
	}
}
