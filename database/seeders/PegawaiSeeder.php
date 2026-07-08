<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama' => 'Andi Saputra', 'nip' => '198501012010011001', 'bidang' => 'Sekretariat'],
            ['nama' => 'Budi Hartono', 'nip' => '198702022011012002', 'bidang' => 'IKP'],
            ['nama' => 'Citra Dewi', 'nip' => '199003032015012003', 'bidang' => 'KIPS'],
            ['nama' => 'Dedi Kurniawan', 'nip' => '199206062018011004', 'bidang' => 'APTIKA'],
        ];

        foreach ($data as $row) {
            Pegawai::updateOrCreate(['nip' => $row['nip']], $row);
        }
    }
}