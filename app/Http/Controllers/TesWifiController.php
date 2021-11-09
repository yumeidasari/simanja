<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tes;
use App\Models\RefOPD;
use App\Models\RefAlat;
use App\Models\JaringanOpd;
use App\Imports\OpdImport;
use App\Exports\OpdExport;
use Excel;
use Illuminate\Support\Facades\DB;


class TesWifiController extends Controller
{
    //
	public function index(Request $request)
    {
		$cari = $request->get('search');

        $semua_server = DB::table('ref_server')
                        ->select('ref_server.*')
                        ->where('ref_server.nama_server', 'LIKE', '%'.$cari.'%')
						->orwhere('ref_server.model_server', 'LIKE', '%'.$cari.'%')
						->orderby('ref_server.nama_server','asc')
                        ->paginate(5);
		
		$tes_server 	= Tes::all();
		 
		$total_server = count($tes_server);
		
		if($total_server != 0)
		{
			for($i=0; $i < $total_server; $i++)
			{
				$vm = DB::table('virtual_machine')
						->join('ref_alat', 'virtual_machine.id_alat', '=', 'ref_alat.id')
                        ->select('virtual_machine.*','ref_alat.nama_alat', 'ref_alat.tipe', 'ref_alat.model')
                        ->where('virtual_machine.server_vm', '=', $tes_server[$i]->nama_server)
						->get();
						
				$jml_vm = count($vm);
				
				$tes_server[$i]->jml_host = $jml_vm;
				$tes_server[$i]->save();
			}
		}
		
		$host_vm  = DB::table('virtual_machine')
						->join('ref_alat', 'virtual_machine.id_alat', '=', 'ref_alat.id')
                        ->select('virtual_machine.*','ref_alat.nama_alat', 'ref_alat.tipe', 'ref_alat.model')
						->orderby('virtual_machine.server_vm','asc')
                        ->get();
		//return response()->json(['data' => $host_vm]);
        return view('tes-wifi.index', compact('semua_server', 'tes_server', 'host_vm'));
       
    }
	
	public function store(Request $request)
	{
		$server_baru = new Tes;  //--->> new Nama MOdel!!!!
		$server_baru->nama_server = $request->nama_server;
		$server_baru->model_server = $request->model_server;
		
		$server_baru->save();
		
		return redirect()->to('tes-wifi')->with('message','Berhasil menambah Data Server');
	}
	
	public function destroy($id)
    {
       // $this->authorize('kelola-user');
        $jaringan=JaringanOpd::findOrFail($id);
        $jaringan->delete();
        return redirect()->to('perangkat-jaringan-tes')->with('message','Berhasil hapus data Perangkat');
    }
	
}