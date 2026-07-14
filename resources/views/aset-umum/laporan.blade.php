<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; font-size: 10px; color: #000; }
        .header-title { text-align: center; font-size: 13px; font-weight: bold; margin-bottom: 2px; text-transform: uppercase; }
        .header-sub { text-align: center; font-size: 11px; font-weight: bold; margin-bottom: 14px; text-transform: uppercase; }
        table.data { width: 100%; border-collapse: collapse; }
        table.data th, table.data td { border: 1px solid #000; padding: 4px 5px; }
        table.data th { background-color: #0B3D66; color: #fff; text-align: center; font-size: 9.5px; }
        .bidang-row td { background-color: #EAF2FB; font-weight: bold; }
        td.center { text-align: center; }
        table.ttd { width: 100%; margin-top: 30px; border: none; }
        table.ttd td { border: none; vertical-align: top; padding: 0; }
        .ttd-box { width: 45%; text-align: center; }
        .ttd-space { height: 55px; }
    </style>
</head>
<body>
    <div class="header-title">Daftar Aset / Barang</div>
    <div class="header-sub">Pada Dinas Komunikasi, Informatika, Statistik Dan Persandian</div>

    <table class="data">
        <thead>
            <tr>
                <th rowspan="2" style="width:3%">No.</th>
                <th rowspan="2" style="width:11%">Bidang</th>
                <th rowspan="2" style="width:8%">Kode Barang</th>
                <th rowspan="2" style="width:13%">Nama Pengguna Barang</th>
                <th rowspan="2" style="width:14%">Nama Barang</th>
                <th rowspan="2" style="width:10%">Merek</th>
                <th rowspan="2" style="width:8%">Tahun Pembelian</th>
                <th colspan="3" style="width:9%">Kondisi Barang</th>
                <th rowspan="2" style="width:15%">Keterangan</th>
            </tr>
            <tr>
                <th style="width:3%">B</th>
                <th style="width:3%">RR</th>
                <th style="width:3%">RB</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; $bidangSekarang = null; @endphp
            @foreach($data as $row)
                @if($bidangSekarang !== $row->bidang)
                    @php $bidangSekarang = $row->bidang; @endphp
                    <tr class="bidang-row">
                        <td colspan="11">{{ $bidangSekarang }}</td>
                    </tr>
                @endif
                <tr>
                    <td class="center">{{ $no++ }}</td>
                    <td>{{ $row->bidang }}</td>
                    <td class="center">{{ $row->kode_barang }}</td>
                    <td>{{ $row->penanggung_jawab }}</td>
                    <td>{{ $row->nama_aset }}</td>
                    <td>{{ $row->merek }}</td>
                    <td class="center">{{ $row->thn_pengadaan }}</td>
                    <td class="center">{{ $row->kondisi_aset == 'baik' ? 'V' : '' }}</td>
                    <td class="center">{{ $row->kondisi_aset == 'rusak ringan' ? 'V' : '' }}</td>
                    <td class="center">{{ $row->kondisi_aset == 'rusak berat' ? 'V' : '' }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($row->deskripsi, 35) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="ttd">
        <tr>
            <td style="width:55%"></td>
            <td class="ttd-box">
                Manggar, {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}<br>
                Kepala Dinas Komunikasi, Informatika, Statistik dan Persandian<br>
                Kabupaten Belitung Timur
                <div class="ttd-space"></div>
                <strong><u>ROYAN AGUSRIADIE, S.Kom</u></strong><br>
                Pembina / IV.a<br>
                NIP. 19760821 200501 1 006
            </td>
        </tr>
    </table>
</body>
</html>