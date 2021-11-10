<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aplikasi;
use App\Models\RefOPD;
use App\Imports\AplikasiImport;
use App\Exports\AplikasiExport;
use Excel;
use Illuminate\Support\Facades\DB;

class AplikasiController extends Controller
{
    //public function index()
	public function index(Request $request)
    {
		//$semua_aplikasi = Aplikasi::orderBy('id','DESC')->paginate(5);
		//$semua_aplikasi = Aplikasi::sortable()->paginate(5);
		$cari = $request->get('search');

        $semua_aplikasi = DB::table('aplikasi')
						->join('ref_opd', 'aplikasi.id_opd', '=', 'ref_opd.id')
                        ->select('aplikasi.*', 'ref_opd.nama_opd')
                        ->where('aplikasi.nama_aplikasi', 'LIKE', '%'.$cari.'%')
						->orwhere('ref_opd.nama_opd', 'LIKE', '%'.$cari.'%')
						->orwhere('aplikasi.domain_url', 'LIKE', '%'.$cari.'%')
						->orwhere('aplikasi.domain_ip', 'LIKE', '%'.$cari.'%')
						->orwhere('aplikasi.link_repo', 'LIKE', '%'.$cari.'%')
						->orderby('aplikasi.id','desc')
                        ->paginate(5);
						
		$semua_opd = RefOPD::orderby('nama_opd', 'ASC')->get();
		
        return view('aplikasi.index', compact('semua_aplikasi', 'semua_opd'));
        //return view('users.index', ['users' => $model->paginate(15)]);
    }
	
	public function store(Request $request)
    {
        //$this->authorize('kelola-user');
		$request->validate([
            "id_opd" => "required",
            "nama_aplikasi" => "required",
            "link_repo" 	=> "required",
			"letak_server" 	=> "required",
			"domain_ip" 	=> "required",
			"domain_url" 	=> "required",
			"platform" 	=> "required"
            
        ]);
		
        $aplikasi = new Aplikasi;  //--->> new Nama MOdel!!!!
        $aplikasi->id_opd=$request->id_opd;
		$aplikasi->nama_aplikasi=$request->nama_aplikasi;
		$aplikasi->link_repo=$request->link_repo;
		$aplikasi->letak_server=$request->letak_server;
		$aplikasi->domain_ip=$request->domain_ip;
		$aplikasi->domain_url=$request->domain_url;
		$aplikasi->fungsi=$request->fungsi;
		$aplikasi->jenis_layanan=$request->jenis_layanan;
		$aplikasi->platform=$request->platform;
		$aplikasi->versi=$request->versi;
		$aplikasi->pengembang=$request->pengembang;
		$aplikasi->bhs_pemrograman=$request->bhs_pemrograman;
        
        $aplikasi->save();
		//return response()->json(['data' => $user]);
        return redirect()->to('aplikasi')->with('message','Berhasil menambah Data Aplikasi');
    }
	
	public function update(Request $request, $id)
    {
        //$this->authorize('kelola-user');
		$request->validate([
            "id_opd" => "required",
            "nama_aplikasi" => "required",
            "link_repo" 	=> "required",
			"letak_server" 	=> "required",
			"domain_ip" 	=> "required",
			"domain_url" 	=> "required",
			"platform" 	=> "required"
            
        ]);
		
		$aplikasi=Aplikasi::findOrFail($id);
		        
        $aplikasi->id_opd=$request->id_opd;
		$aplikasi->nama_aplikasi=$request->nama_aplikasi;
		$aplikasi->link_repo=$request->link_repo;
		$aplikasi->letak_server=$request->letak_server;
		$aplikasi->domain_ip=$request->domain_ip;
		$aplikasi->domain_url=$request->domain_url;
		$aplikasi->fungsi=$request->fungsi;
		$aplikasi->jenis_layanan=$request->jenis_layanan;
		$aplikasi->platform=$request->platform;
		$aplikasi->versi=$request->versi;
		$aplikasi->pengembang=$request->pengembang;
		$aplikasi->bhs_pemrograman=$request->bhs_pemrograman;
		
		$aplikasi->save();
		//return response()->json(['data' => $user]);
        return redirect()->to('aplikasi')->with('message','Berhasil update data Aplikasi');
    }
	
	public function destroy($id)
    {
       // $this->authorize('kelola-user');
        $aplikasi=Aplikasi::findOrFail($id);
        $aplikasi->delete();
        return redirect()->to('aplikasi')->with('message','Berhasil hapus data Aplikasi');
    }
	
	public function processImport(Request $request)
	{
		$request->validate([
			"file" => "required|file|mimes:xls,xlsx|max:10000"
		]);

		Excel::import(new AplikasiImport, $request->file);
		//return response()->json(['data' => $request]);
		return redirect()->to('aplikasi')->with('message', 'Data Aplikasi berhasil diimport');
	}
	
	//untuk EKSPORT ke file excel
	public function processExport()
	{		
		return Excel::download(new AplikasiExport, 'aplikasi.xlsx');
	}
	
	
}
