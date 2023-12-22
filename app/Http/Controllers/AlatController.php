<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RefAlat;
use App\Imports\AlatImport;
use App\Exports\AlatExport;
use App\Models\DetailAlat;
use App\Exports\DetailAlatExport;
use App\Models\UnitKerja;
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
	
	public function detailAlat($id){
		//return response()->json(['data' => $id]);
		$data = RefAlat::findOrFail($id);
		$detil = DB::table('detail_alat')
							->join('ref_alat', 'ref_alat.id', '=', 'detail_alat.id_alat')
							->select('detail_alat.*')
							->where('detail_alat.id_alat', $id)
							->paginate();
		
		return view('alat.detail_alat', compact('data', 'detil'));
	}
	
	public function storeDetail(Request $request)
    {
        //$this->authorize('kelola-user');
				
        $alat = new DetailAlat; 
        $alat->tgl_pengadaan=$request->tgl_pengadaan;
		$alat->jumlah=$request->jumlah;
		$alat->harga=$request->harga;
		$alat->createdBy = auth()->user()->id;
		$alat->id_alat = $request->id_alat;
        
        $alat->save();
		//return response()->json(['data' => $user]);
        return redirect()->to('alat')->with('message','Berhasil menambah Data Detail Peralatan Jaringan');
    }
	
	public function updateDetail(Request $request, $id)
	{
		$alat=DetailAlat::findOrFail($id);
		        
        $alat->tgl_pengadaan=$request->tgl_pengadaan;
		$alat->jumlah=$request->jumlah;
		$harga = trim($request->harga, "Rp. ");
		$alat->harga= $harga;
		$alat->updatedBy = auth()->user()->id;
        
        $alat->save();
		return redirect()->to('alat')->with('message','Berhasil update data detail Peralatan Jaringan');
	}
	
	public function hapusDetail($id)
	{
		$alat=DetailAlat::findOrFail($id);
        $alat->delete();
        return redirect()->to('alat')->with('message','Berhasil hapus data Detail Peralatan Jaringan');
	}
	
	public function exportDetail()
	{		
		return Excel::download(new DetailAlatExport, 'detail-alat.xlsx');
	}
		
	public static function encryptId($id)
    {
        return $id . 'z' . md5($id);
    }
}
