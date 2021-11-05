<?php

namespace App\Imports;

use App\Models\Wireless;
use App\Models\RefOPD;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


//class WirelessImports implements ToModel
class WirelessImports implements ToModel, WithHeadingRow
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
		
		/*$wireless = new Wireless([
           
			'id_opd' => $opd->id,
			'ip_client' => $row['ip_client'],
			'ip_router' => $row['ip_router'],
			'keterangan' => $row['keterangan'],
				
        ]);*/
		$wireless = new Wireless; 
		$wireless->id_opd = $opd->id;
		$wireless->ip_client = $row['ip_client'];
		$wireless->ip_router = $row['ip_router'];
		$wireless->keterangan = $row['keterangan'];
		$wireless->save();
		
		//dd($wireless->all());
		//return response()->json(['data' => $wireless]);
		
    }
	
	
}
