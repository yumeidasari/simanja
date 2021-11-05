<?php

namespace App\Imports;

use App\Models\Vm;
use App\Models\RefAlat;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VmImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
		$alat = RefAlat::where("nama_alat", $row['nama_alat'])
				->where("model", $row['model'])
				->first();	
		//dd($alat->all());
		
		if(!$alat){
            
            $alat = new RefAlat;
            $alat->nama_alat = $row['nama_alat'];
			$alat->tipe = $row['tipe'];
			$alat->model = $row['model'];
            $alat->save();
        }
		
		$vm = new Vm;
		$vm->id_alat = $alat->id;
		$vm->nama_vm = $row['nama_vm'];
		$vm->ip_vm = $row['ip_vm'];
		$vm->os_vm = $row['os_vm'];
		$vm->server_vm= $row['server_vm'];
		$vm->save();
		//dd($wireless->all());
		
		/*
        return new JaringanOpd([
            //
        ]);
		*/
    }
}
