<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RefAlat;
use App\Imports\AlatImport;
use App\Exports\AlatExport;
use Excel;
use Illuminate\Support\Facades\DB;

class AlatController extends Controller
{
    //public function index()
	public function index(Request $request)
    {		
		//$semua_alat = RefAlat::orderBy('id','DESC')->paginate(5);
		//$semua_alat = RefAlat::sortable()->paginate(5);
		
		$cari = $request->get('search');

        $semua_alat = DB::table('ref_alat')
                        ->select('ref_alat.*')
                        ->where('ref_alat.nama_alat', 'LIKE', '%'.$cari.'%')
						->orwhere('ref_alat.tipe', 'LIKE', '%'.$cari.'%')
						->orwhere('ref_alat.model', 'LIKE', '%'.$cari.'%')
						->orderby('ref_alat.id','desc')
                        ->paginate(5);
						
        return view('alat.index', compact('semua_alat'));       
    }
	
	public function store(Request $request)
    {
        //$this->authorize('kelola-user');
		$request->validate([
            "nama_alat" => "required",
            "tipe" 		=> "required",
            "model" 	=> "required"
            
        ]);
		
        $alat = new RefAlat;  //--->> new Nama MOdel!!!!
        $alat->nama_alat=$request->nama_alat;
		$alat->tipe=$request->tipe;
		$alat->model=$request->model;
        
        $alat->save();
		//return response()->json(['data' => $user]);
        return redirect()->to('alat')->with('message','Berhasil menambah Data Peralatan Jaringan');
    }
	
	public function update(Request $request, $id)
    {
        //$this->authorize('kelola-user');
		$request->validate([
            "nama_alat" => "required",
            "tipe" 		=> "required",
            "model" 	=> "required"
            
        ]);
		
		$alat=RefAlat::findOrFail($id);
		        
        $alat->nama_alat=$request->nama_alat;
		$alat->tipe=$request->tipe;
		$alat->model=$request->model;
        
        $alat->save();
		//return response()->json(['data' => $user]);
        return redirect()->to('alat')->with('message','Berhasil update data Peralatan Jaringan');
    }
	
	public function destroy($id)
    {
       // $this->authorize('kelola-user');
        $alat=RefAlat::findOrFail($id);
        $alat->delete();
        return redirect()->to('alat')->with('message','Berhasil hapus data Peralatan Jaringan');
    }
	
	//Untuk IMPORT file
	
	public function processImport(Request $request)
	{
		//dd($request->all());
		$request->validate([
			"file" => "required|file|mimes:xls,xlsx|max:10000"
		]);

		Excel::import(new AlatImport, $request->file);
		//return response()->json(['data' => $request]);
		
		return redirect()->to('alat')->with('message', 'Data Peralatan telah berhasil diimport');
	}
	
	//untuk EKSPORT ke file excel
	public function processExport()
	{		
		return Excel::download(new AlatExport, 'alat.xlsx');
	}
}
