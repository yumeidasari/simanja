<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RefOPD;
use App\Models\Wireless;
use App\Models\Aplikasi;
use App\Models\JaringanOpd;
use App\Imports\OpdImport;
use App\Exports\OpdExport;
use Excel;
use Illuminate\Support\Facades\DB;

class OpdController extends Controller
{
    //public function index()
	public function index(Request $request)
    {
		
		//$semua_opd = RefOPD::orderBy('id','DESC')->paginate(5);
		//$semua_opd = RefOPD::sortable()->paginate(5);
		
		$cari = $request->get('search');

        $semua_opd = DB::table('ref_opd')
                        ->select('ref_opd.*')
                        ->where('ref_opd.nama_opd', 'LIKE', '%'.$cari.'%')
						->orderby('ref_opd.nama_opd','asc')
                        ->paginate(5);
        return view('opd.index', compact('semua_opd'));
       
    }
	
	public function store(Request $request)
    {
        //$this->authorize('kelola-user');
		$request->validate([
            "nama_opd" => "required"
            
        ]);
				
        $opd = new RefOPD;  //--->> new Nama MOdel!!!!
        $opd->nama_opd=$request->nama_opd;
        
        $opd->save();
		//return response()->json(['data' => $user]);
        return redirect()->to('opd')->with('message','Berhasil menambah Data OPD');
    }
	
	public function update(Request $request, $id)
    {
        //$this->authorize('kelola-user');
		$request->validate([
            "nama_opd" => "required"
            
        ]);
		
		$opd=RefOPD::findOrFail($id);
		        
        $opd->nama_opd=$request->nama_opd;
        $opd->save();
		//return response()->json(['data' => $user]);
        return redirect()->to('opd')->with('message','Berhasil update data OPD');
    }
	
	public function destroy($id)
    {
       // $this->authorize('kelola-user');
        $opd=RefOPD::findOrFail($id);
		//----------Alamat IP
		$semua_wireless = DB::table('wireless')
						->select('wireless.*')
                        ->where('wireless.id_opd', '=', $opd->id)
						->delete();
						
		//----------Aplikasi
		$semua_aplikasi = DB::table('aplikasi')
						->select('aplikasi.*')
                        ->where('aplikasi.id_opd', '=', $opd->id)
						->delete();
						
		//----------Perangkat JaringanOpd
		$semua_jaringan = DB::table('jaringan_opd')
						->select( 'jaringan_opd.*')
                        ->where('jaringan_opd.id_opd', '=', $opd->id)
						->delete();
        $opd->delete();
        return redirect()->to('opd')->with('message','Berhasil hapus data OPD');
    }
	
	//Untuk IMPORT file
	public function import()
	{
		return view('opd.import');
	}
	
	public function processImport(Request $request)
	{
		//dd($request->all());
		$request->validate([
			"file" => "required|file|mimes:xls,xlsx|max:10000"
		]);

		Excel::import(new OpdImport, $request->file);
		//return response()->json(['data' => $request]);
		
		return redirect()->to('opd')->with('message', 'Data OPD telah berhasil diimport');
	}
	
	//untuk EKSPORT ke file excel
	public function processExport()
	{		
		return Excel::download(new OpdExport, 'opd.xlsx');
	}
}
