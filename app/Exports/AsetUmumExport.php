<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class AsetUmumExport implements WithEvents, WithColumnWidths
{
    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 24,
            'C' => 14,
            'D' => 22,
            'E' => 22,
            'F' => 16,
            'G' => 14,
            'H' => 5,
            'I' => 5,
            'J' => 5,
            'K' => 35,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // ---------- Judul ----------
                $sheet->setCellValue('A1', 'DAFTAR ASET / BARANG');
                $sheet->mergeCells('A1:K1');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(13);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->setCellValue('A2', 'PADA DINAS KOMUNIKASI, INFORMATIKA, STATISTIK DAN PERSANDIAN');
                $sheet->mergeCells('A2:K2');
                $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(11);
                $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // ---------- Header tabel (baris 4-5) ----------
                $headerRow1 = 4;
                $headerRow2 = 5;

                $headersVertikal = [
                    'A' => 'No.',
                    'B' => 'Bidang',
                    'C' => 'Kode Barang',
                    'D' => 'Nama Pengguna Barang',
                    'E' => 'Nama Barang',
                    'F' => 'Merek',
                    'G' => 'Tahun Pembelian',
                    'K' => 'Keterangan',
                ];
                foreach ($headersVertikal as $col => $label) {
                    $sheet->setCellValue($col.$headerRow1, $label);
                    $sheet->mergeCells($col.$headerRow1.':'.$col.$headerRow2);
                }
                $sheet->setCellValue('H'.$headerRow1, 'Kondisi Barang');
                $sheet->mergeCells('H'.$headerRow1.':J'.$headerRow1);
                $sheet->setCellValue('H'.$headerRow2, 'B');
                $sheet->setCellValue('I'.$headerRow2, 'RR');
                $sheet->setCellValue('J'.$headerRow2, 'RB');

                $headerRange = 'A'.$headerRow1.':K'.$headerRow2;
                $sheet->getStyle($headerRange)->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
                $sheet->getStyle($headerRange)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('0B3D66');
                $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);
                $sheet->getStyle($headerRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                // ---------- Data ----------
                $data = DB::table('aset_kantor')
                            ->join('unit_kerja', 'unit_kerja.id', '=', 'aset_kantor.id_unit_kerja')
                            ->select('aset_kantor.*', 'unit_kerja.nama_unit_kerja as bidang')
                            ->orderBy('unit_kerja.nama_unit_kerja')
                            ->orderBy('aset_kantor.nama_aset')
                            ->get();

                $currentRow = $headerRow2 + 1;
                $no = 1;
                $bidangSekarang = null;

                foreach ($data as $row) {
                    if ($bidangSekarang !== $row->bidang) {
                        $bidangSekarang = $row->bidang;
                        $sheet->setCellValue('A'.$currentRow, $bidangSekarang);
                        $sheet->mergeCells('A'.$currentRow.':K'.$currentRow);
                        $sheet->getStyle('A'.$currentRow)->getFont()->setBold(true);
                        $sheet->getStyle('A'.$currentRow)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('EAF2FB');
                        $currentRow++;
                    }

                    $sheet->setCellValue('A'.$currentRow, $no++);
                    $sheet->setCellValue('B'.$currentRow, $row->bidang);
                    $sheet->setCellValue('C'.$currentRow, $row->kode_barang);
                    $sheet->setCellValue('D'.$currentRow, $row->penanggung_jawab);
                    $sheet->setCellValue('E'.$currentRow, $row->nama_aset);
                    $sheet->setCellValue('F'.$currentRow, $row->merek);
                    $sheet->setCellValue('G'.$currentRow, $row->thn_pengadaan);
                    $sheet->setCellValue('H'.$currentRow, $row->kondisi_aset == 'baik' ? 'V' : '');
                    $sheet->setCellValue('I'.$currentRow, $row->kondisi_aset == 'rusak ringan' ? 'V' : '');
                    $sheet->setCellValue('J'.$currentRow, $row->kondisi_aset == 'rusak berat' ? 'V' : '');
                    $sheet->setCellValue('K'.$currentRow, Str::limit((string) $row->deskripsi, 100));

                    $currentRow++;
                }

                $lastDataRow = $currentRow - 1;
                if ($lastDataRow >= $headerRow2 + 1) {
                    $dataRange = 'A'.($headerRow2 + 1).':K'.$lastDataRow;
                    $sheet->getStyle($dataRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                    $sheet->getStyle('A'.($headerRow2 + 1).':A'.$lastDataRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle('C'.($headerRow2 + 1).':C'.$lastDataRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle('G'.($headerRow2 + 1).':J'.$lastDataRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }

                // ---------- Tanda tangan ----------
                $ttdRow = $lastDataRow + 3;

                $sheet->setCellValue('I'.$ttdRow, 'Manggar, '.\Carbon\Carbon::now()->translatedFormat('F Y'));
                $sheet->setCellValue('I'.($ttdRow + 1), 'Kepala Dinas Komunikasi, Informatika, Statistik dan Persandian');
                $sheet->setCellValue('I'.($ttdRow + 2), 'Kabupaten Belitung Timur');
                $sheet->setCellValue('I'.($ttdRow + 6), 'ROYAN AGUSRIADIE, S.Kom');
                $sheet->setCellValue('I'.($ttdRow + 7), 'Pembina / IV.a');
                $sheet->setCellValue('I'.($ttdRow + 8), 'NIP. 19760821 200501 1 006');

                foreach ([0, 1, 2, 6, 7, 8] as $offset) {
                    $r = $ttdRow + $offset;
                    $sheet->mergeCells('I'.$r.':K'.$r);
                    $sheet->getStyle('I'.$r)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setWrapText(true);
                }
                $sheet->getStyle('I'.($ttdRow + 6))->getFont()->setBold(true)->setUnderline(true);
            },
        ];
    }
}