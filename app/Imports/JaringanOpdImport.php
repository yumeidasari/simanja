<?php

namespace App\Imports;

use App\Models\JaringanOpd;
use App\Models\RefOPD;
use App\Models\RefAlat;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JaringanOpdImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
		$opd = RefOPD::where("nama_opd", $row['nama_opd'])->first();	
		
		if(!$opd){
            
            $opd = new RefOPD;
            $opd->nama_opd = $row['nama_opd'];
            $opd->save();
        }
		
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
		
		$jaringanOpd = new JaringanOpd;
		$jaringanOpd->id_opd = $opd->id;
		$jaringanOpd->id_alat = $alat->id;
		$jaringanOpd->kondisi = $row['kondisi'];
		$jaringanOpd->kode_alat = $row['kode_alat'];
		$jaringanOpd->save();
		//dd($wireless->all());
		
		/*
        return new JaringanOpd([
            //
        ]);
		*/
    }
}
