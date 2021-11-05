<?php

namespace App\Imports;

use App\Models\Aplikasi;
use App\Models\RefOPD;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AplikasiImport implements ToModel, WithHeadingRow
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
		
		$aplikasi = new Aplikasi;
		$aplikasi->id_opd		=$opd->id;
		$aplikasi->nama_aplikasi=$row['nama_aplikasi'];
		$aplikasi->link_repo	=$row['link_repo'];
		$aplikasi->letak_server	=$row['letak_server'];
		$aplikasi->domain_ip	=$row['domain_ip'];
		$aplikasi->domain_url	=$row['domain_url'];
		$aplikasi->fungsi		=$row['fungsi'];
		$aplikasi->jenis_layanan=$row['jenis_layanan'];
		$aplikasi->platform		=$row['platform'];
		$aplikasi->versi		=$row['versi'];
		$aplikasi->pengembang	=$row['pengembang'];
		$aplikasi->bhs_pemrograman=$row['bhs_pemrograman'];
		
		$aplikasi->save();
		/*
        return new Aplikasi([
            //
        ]);
		*/
    }
}
