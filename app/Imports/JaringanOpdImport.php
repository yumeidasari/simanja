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
		$nama_opd = strtoupper($row['nama_opd']);
		$nama_alat= strtoupper($row['nama_alat']);
		$model_alat = strtoupper($row['model']);
		$tipe = strtoupper($row['tipe']);
		
		
		$opd = RefOPD::where("nama_opd", $nama_opd)->first();	
		
		if(!$opd){
            
            $opd = new RefOPD;
            $opd->nama_opd = $nama_opd;
            $opd->save();
        }
				
		$alat = RefAlat::where("nama_alat", $nama_alat)
				->where("model", $model_alat)
				->first();	
		//dd($alat->all());
		
		if(!$alat){
            
            $alat = new RefAlat;
            $alat->nama_alat = $nama_alat;
			$alat->tipe = $tipe;
			$alat->model = $model_alat;
            $alat->save();
        }
		
		$jaringanOpd = new JaringanOpd;
		$jaringanOpd->id_opd = $opd->id;
		$jaringanOpd->id_alat = $alat->id;
		$jaringanOpd->kondisi = strtoupper($row['kondisi']);
		$jaringanOpd->kode_alat = strtoupper($row['kode_alat']);
		$jaringanOpd->save();
		//dd($wireless->all());
		
		/*
        return new JaringanOpd([
            //
        ]);
		*/
    }
}
