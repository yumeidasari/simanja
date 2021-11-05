<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\RefAlat;

class AlatExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //use Exportable;
		return RefAlat::all();
		
    }
	
	public function headings():array
	{
		return[
			'ID',
			'NAMA ALAT',
			'TIPE',
			'MODEL',
			'TGL INPUT DATA',
			'TGL UPDATE DATA',
		];
	}
		
}
