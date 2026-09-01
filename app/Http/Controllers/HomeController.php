<?php

namespace App\Http\Controllers;
use App\Models\Aplikasi;
use App\Models\RefOPD;
use App\Models\JaringanOpd;
use App\Models\Wireless;
use App\Models\LogUser;
use Illuminate\Support\Facades\DB;

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
	 
	public function logUser($id_user, $act)
    {
        // insert login activity user
        $log = new LogUser;
        $log->id_user = $id_user;
        $log->activity = $act;
        $log->save();
    }
	
    public function index()
    {
		$this->logUser(auth()->user()->id, 'Login');

		// ---------- Dashboard USER: fokus breakdown Aset Umum ----------
		if (auth()->user()->role == 'USER') {

			$asetQuery = DB::table('aset_kantor')
						->where('id_unit_kerja', auth()->user()->id_bidang);

			$jml_aset_total = (clone $asetQuery)->count();
			$jml_aset_baik = (clone $asetQuery)->where('kondisi_aset', 'baik')->count();
			$jml_aset_rusak_ringan = (clone $asetQuery)->where('kondisi_aset', 'rusak ringan')->count();
			$jml_aset_rusak_berat = (clone $asetQuery)->where('kondisi_aset', 'rusak berat')->count();

			return view('dashboard-user', compact(
				'jml_aset_total', 'jml_aset_baik', 'jml_aset_rusak_ringan', 'jml_aset_rusak_berat'
			));
		}

		// ---------- Dashboard ADMIN: tampilan lengkap seperti sebelumnya ----------
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
            'titleTextStyle' => ['fontName' => 'Poppins', 'fontSize' => 16, 'bold' => true, 'color' => '#0B3D66'],
			'is3D'   => true,
            'width'  => '100%',
            'chartArea' => ['left' => '5%', 'top' => 10, 'width' => '90%', 'height' => '85%'],
            'legend' => ['textStyle' => ['fontName' => 'Poppins', 'color' => '#2D3436']],
            'backgroundColor' => 'transparent',
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
            "width" => "100%",
            "chartArea" => ["left" => "5%", "top" => 10, "width" => "90%", "height" => "85%"],
            "legend" => ["textStyle" => ["fontName" => "Poppins", "color" => "#2D3436"]],
            "backgroundColor" => "transparent",
            "orientation" => "horizontal"
        ]);
		
        return view('dashboard', compact('jml_opd', 'jml_aplikasi', 'jml_wireless', 'jml_jaringan', 'pieByJenis', 'pieByOpd'));
    }
}