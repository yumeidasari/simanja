<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Tes;
use App\Models\RefOPD;
//use App\Imports\WirelessImports;
//use App\Exports\WirelessExport;
//use Excel;


class TesWifiController extends Controller
{
    //
	public function index(Request $request)
    {
		//$semua_user = User::all();
		//$semua_wireless = Wireless::orderBy('id','DESC')->paginate(5);
		$cari = $request->get('search');

        $semua_wireless = DB::table('tes')
						->join('ref_opd', 'tes.id_opd', '=', 'ref_opd.id')
                        ->select('tes.*', 'ref_opd.*')
                        ->where('ref_opd.nama_opd', 'LIKE', '%'.$cari.'%')
						->orwhere('tes.ip_client', 'LIKE', '%'.$cari.'%')
						->orwhere('tes.ip_router', 'LIKE', '%'.$cari.'%')
						->orderby('tes.id','desc')
                        ->paginate(5);
						
		$semua_opd 	= RefOPD::all();
		
        return view('tes-wifi.index', compact('semua_wireless', 'semua_opd'));
        //return view('users.index', ['users' => $model->paginate(15)]);
    }
	
	public function store(Request $request)
    {
        //$this->authorize('kelola-user');
				
        $wireless = new Tes;  //--->> new Nama MOdel!!!!
        $wireless->id_opd=$request->id_opd;
		$wireless->ip_client=$request->ip_client;
		$wireless->ip_router=$request->ip_router;
		$wireless->keterangan = $request->keterangan;        
        $wireless->save();
		//return response()->json(['data' => $user]);
        return redirect()->to('tes-wifi')->with('message','Berhasil menambah Data Wireless');
    }
	
	public function update(Request $request, $id)
    {
        $tes_wireless= Tes::findOrFail($id);
		        
		$tes_wireless->id_opd=$request->id_opd;
		$tes_wireless->ip_client=$request->ip_client;
		$tes_wireless->ip_router=$request->ip_router;
		$tes_wireless->keterangan = $request->keterangan;        
        $tes_wireless->save();
		return response()->json(['data' => $user]);
        //return redirect()->to('tes-wifi')->with('message','Berhasil update data Wireless');
    }
	
}
