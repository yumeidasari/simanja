<?php

namespace App\Imports;

use App\Models\RefAlat;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlatImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new RefAlat([
            //
			'nama_alat' => $row['nama_alat'],
			'tipe' => $row['tipe'],
			'model' => $row['model'],
        ]);
    }
}
