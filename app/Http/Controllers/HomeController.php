<?php

namespace App\Http\Controllers;
use App\Models\Aplikasi;
use App\Models\RefOPD;
use App\Models\JaringanOpd;
use App\Models\Wireless;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {	
		$opd = RefOPD::all();
		$jml_opd = count($opd);
		
		$aplikasi = Aplikasi::all();
		$jml_aplikasi = count($aplikasi);
		
		$wireless = Wireless::all();
		$jml_wireless = count($wireless);
		
		$jaringan = JaringanOpd::all();
		$jml_jaringan = count($jaringan);
		
		/****************CHART*****************/
		
		$dataTable = \Lava::DataTable();

		$dataTable->addStringColumn('Jenis Layanan')
			->addNumberColumn('Percent');


		$aplikasi_count = Aplikasi::count();
		
		
		//Aplikasi berdasarkan jenis Layanan
		
		$aplikasi_by_jenis_layanan = Aplikasi::groupBy('jenis_layanan')
			->select('jenis_layanan', \DB::raw('count(*) as count'))
			->get();

		foreach ($aplikasi_by_jenis_layanan as $jenis_layanan) 
		{
			$dataTable->addRow([$jenis_layanan->jenis_layanan, $jenis_layanan->count / $aplikasi_count]);
		}

		$pieByJenis = \Lava::PieChart('pie_by_jenis', $dataTable, [
			'title'  => 'Aplikasi berdasarkan jenis Layanan',
			'is3D'   => true,
			'slices' => [
				['offset' => 0.2],
				['offset' => 0.25],
				['offset' => 0.3]
			]
		]);
		
		//APlikasi berdasarkan OPD
		
		$aplikasi_by_opd = Aplikasi::with('opd')->get()->map(function ($aplikasi_all) {
            $aplikasi_all->nama_opd = $aplikasi_all->opd->nama_opd;
            return $aplikasi_all;
        })->groupBy('nama_opd');
		
        $byOPDTable = \Lava::DataTable()
            ->addStringColumn('opd')
            ->addNumberColumn('jumlah');

        foreach ($aplikasi_by_opd as $opd_all) {
            $nama_opd = $opd_all->pluck('nama_opd')[0];
            $byOPDTable->addRow([$nama_opd, count($opd_all)]);
        }

        $pieByOpd = \Lava::PieChart('pie_by_opd', $byOPDTable, [
            "title" => "Aplikasi berdasarkan OPD",
            "orientation" => "horizontal"
        ]);
		
		
		// aset by kondisi

		/*
        $aset_by_kondisi = Aset::groupBy('kondisi')
            ->select('kondisi', \DB::raw('count(*) as count'))
            ->get();

        $byKondisiTable = \Lava::DataTable();

        $byKondisiTable
            ->addStringColumn('kondisi')
            ->addNumberColumn('percent');

        foreach ($aset_by_kondisi as $kondisi) 
		{
            $byKondisiTable->addRow([$kondisi->kondisi, $kondisi->count / $aset_count]);
        }

        $pieByKondisi = \Lava::PieChart('pie_by_kondisi', $byKondisiTable);

        // aset by kategori

        $aset_by_kategori = Aset::with('kategori')->get()->map(function ($aset) {
            $aset->nama_kategori = $aset->kategori->nama_kategori;
            return $aset;
        })->groupBy('nama_kategori');

        $byKategoriTable = \Lava::DataTable()
            ->addStringColumn('kategori')
            ->addNumberColumn('jumlah');

        foreach ($aset_by_kategori as $kategori) {
            $nama_kategori = $kategori->pluck('nama_kategori')[0];
            $byKategoriTable->addRow([$nama_kategori, count($kategori)]);
        }

        $pieByKategori = \Lava::PieChart('pie_by_kategori', $byKategoriTable, [
            "title" => "Aset berdasarkan kategori",
            "orientation" => "horizontal"
        ]);


        // aset by satker
        $aset_by_satker = Aset::with('satker')->get()->map(function ($aset) {
            $aset->nama_satker = $aset->satker->nama_satker;
            return $aset;
        })->groupBy('nama_satker');

        $byKategoriTable = \Lava::DataTable()
            ->addStringColumn('satker')
            ->addNumberColumn('jumlah');

        foreach ($aset_by_satker as $satker) {
            $nama_satker = $satker->pluck('nama_satker')[0];
            $byKategoriTable->addRow([$nama_satker, count($satker)]);
        }

        $pieBySatker = \Lava::PieChart('pie_by_satker', $byKategoriTable, [
            "title" => "Aset berdasarkan satker",
            "orientation" => "horizontal"
        ]);
		
        return view('aset/charts', compact('pieByJenis', 'pieByKondisi', 'pieByKategori', 'pieBySatker'));

		*/
		//return view('aset/charts', compact('pieByJenis'));
		//-------------------------------------------------------------
        return view('dashboard', compact('jml_opd', 'jml_aplikasi', 'jml_wireless', 'jml_jaringan', 'pieByJenis', 'pieByOpd'));
		//return view('dashboard', compact('jml_opd', 'jml_aplikasi', 'jml_wireless', 'jml_jaringan'));
    }
}
