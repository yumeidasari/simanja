<?php

namespace App\Exports;

use App\Models\Vm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class VmExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Vm::all();
		$vm = DB::table('virtual_machine')
						->join('ref_alat', 'virtual_machine.id_alat', '=', 'ref_alat.id')
                        ->select('virtual_machine.nama_vm',
								'ref_alat.tipe', 
								'virtual_machine.ip_vm',
								'virtual_machine.os_vm',
								'virtual_machine.server_vm')
						->orderby('virtual_machine.nama_vm','asc')
                        ->get();
		
		return $vm;
    }
	
	public function headings():array
	{
		return[
			'NAMA VM',
			'TIPE',
			'IP VM',
			'OS VM',
			'IP SERVER',
		
		];
	}
}
