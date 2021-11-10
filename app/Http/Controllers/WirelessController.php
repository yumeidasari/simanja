<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Models\Wireless;
use App\Models\RefOPD;
use App\Imports\WirelessImports;
use App\Exports\WirelessExport;
use Excel;
use Illuminate\Support\Facades\DB;

class WirelessController extends Controller
{
    //public function index()
	public function index(Request $request)
    {
		//$semua_user = User::all();
		//$semua_wireless = Wireless::orderBy('id','DESC')->paginate(5);
		$cari = $request->get('search');

        $semua_wireless = DB::table('wireless')
						->join('ref_opd', 'wireless.id_opd', '=', 'ref_opd.id')
                        ->select('wireless.*', 'ref_opd.nama_opd')
                        ->where('ref_opd.nama_opd', 'LIKE', '%'.$cari.'%')
						->orwhere('wireless.ip_client', 'LIKE', '%'.$cari.'%')
						->orwhere('wireless.ip_router', 'LIKE', '%'.$cari.'%')
						->orwhere('ref_opd.nama_opd', 'LIKE', '%'.$cari.'%')
						->orderby('wireless.id','desc')
                        ->paginate(5);
						
		$semua_opd 	= RefOPD::all();
		
        return view('wireless.index', compact('semua_wireless', 'semua_opd'));
        //return view('users.index', ['users' => $model->paginate(15)]);
    }
	
	public function store(Request $request)
    {
        //$this->authorize('kelola-user');
		$request->validate([
            "id_opd" => "required"
            
        ]);		
        $wireless = new Wireless;  //--->> new Nama MOdel!!!!
        $wireless->id_opd=$request->id_opd;
		$wireless->ip_client=$request->ip_client;
		$wireless->ip_router=$request->ip_router;
		$wireless->keterangan = $request->keterangan;        
        $wireless->save();
		//return response()->json(['data' => $user]);
        return redirect()->to('wireless')->with('message','Berhasil menambah Data Wireless');
    }
		
	
	public function update(Request $request, $id)
    {
        //$this->authorize('kelola-user');
		$request->validate([
            "id_opd" => "required"
            
        ]);	
		
		$wireless=Wireless::findOrFail($id);
		        
		$wireless->id_opd=$request->id_opd;
		$wireless->ip_client=$request->ip_client;
		$wireless->ip_router=$request->ip_router;
		$wireless->keterangan = $request->keterangan;        
        $wireless->save();
		//return response()->json(['data' => $user]);
        return redirect()->to('wireless')->with('message','Berhasil update data Wireless');
    }
	
	public function destroy($id)
    {
       // $this->authorize('kelola-user');
        $wireless=Wireless::findOrFail($id);
        $wireless->delete();
        return redirect()->to('wireless')->with('message','Berhasil hapus data Wireless');
    }
	
	public function import()
	{
		return view('wireless.import');
	}
	
	public function processImport(Request $request)
	{

		Excel::import(new WirelessImports, $request->file);
		//return response()->json(['data' => $request]);
		return redirect()->to('wireless')->with('message', 'Data Wireless telah berhasil diimport');
	}
	
	//untuk EKSPORT ke file excel
	public function processExport()
	{		
		return Excel::download(new WirelessExport, 'wireless.xlsx');
	}
}
