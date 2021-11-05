<?php

namespace App\Imports;

use App\Models\RefOPD;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OpdImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
		
        return new RefOPD([
            //
			'nama_opd' => $row['nama_opd'],
        ]);
		
		
		//dd($row['id']);
    }
}
