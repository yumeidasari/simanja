<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Models\JaringanOpd;
use App\Models\RefOPD;
use App\Models\RefAlat;
use App\Imports\JaringanOpdImport;
use App\Exports\JaringanOpdExport;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class JaringanOpdController extends Controller
{
    //public function index()
	public function index(Request $request)
    {
		//$semua_jaringan = JaringanOpd::orderBy('id','DESC')->paginate(5);
		//$semua_jaringan = JaringanOpd::sortable()->paginate(5);
		$cari = $request->get('search');

        $semua_jaringan = DB::table('jaringan_opd')
						->join('ref_opd', 'jaringan_opd.id_opd', '=', 'ref_opd.id')
						->join('ref_alat', 'jaringan_opd.id_alat', '=', 'ref_alat.id')
                        ->select('ref_alat.nama_alat', 'ref_alat.tipe','ref_alat.model', 'ref_opd.nama_opd', 'jaringan_opd.*')
                        ->where('ref_opd.nama_opd', 'LIKE', '%'.$cari.'%')
						->orwhere('ref_alat.nama_alat', 'LIKE', '%'.$cari.'%')
						->orwhere('ref_alat.tipe', 'LIKE', '%'.$cari.'%')
						->orwhere('ref_alat.model', 'LIKE', '%'.$cari.'%')
						->orwhere('jaringan_opd.kode_alat', 'LIKE', '%'.$cari.'%')
						->orwhere('jaringan_opd.kondisi', 'LIKE', '%'.$cari.'%')
						->orderby('jaringan_opd.id','desc')
                        ->paginate(5);
			
		$semua_opd 	= RefOPD::all();
		$semua_alat = RefAlat::all();
		
        return view('jaringan-opd.index', compact('semua_jaringan', 'semua_opd', 'semua_alat'));
        //return view('users.index', ['users' => $model->paginate(15)]);
    }
	
	//paginate
	/*public function arrayPaginator($array, $request)
	{
		$page = new Pagination\Paginator::get('page', 1);
		$perPage = 5;
		$offset = ($page * $perPage) - $perPage;

		return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
			['path' => $request->url(), 'query' => $request->query()]);
	}*/
	
	public function create()
    {
		$semua_opd 	= RefOPD::all();
		$semua_alat = RefAlat::all();
        return view('jaringan-opd.create', compact( 'semua_opd', 'semua_alat'));
    }
	
	public function store(Request $request)
    {
        //$this->authorize('kelola-user');
		$request->validate([
            "id_opd" 	=> "required",
            "id_alat" 	=> "required",
            "kondisi" 	=> "required",
            "kode_alat" => "required"
            
        ]);
		
        $jaringan = new JaringanOpd;  //--->> new Nama MOdel!!!!
        $jaringan->id_opd=$request->id_opd;
		$jaringan->id_alat=$request->id_alat;
		$jaringan->kondisi=$request->kondisi;
		$jaringan->tgl_pemasangan = Carbon::create($request->tgl_pemasangan); 
		$jaringan->kode_alat=$request->kode_alat;
		
		if ($request->hasFile('file')) {
			$path = $request->file('file')->store("/jaringan-opd/", 'public');
			$jaringan->foto = $path;
		}
		
        $jaringan->save();
		//return response()->json(['data' => $user]);
        return redirect()->to('jaringan-opd')->with('message','Berhasil menambah Data Jaringan OPD');
    }
	
	public function edit($id)
    {
        //$this->authorize('kelola-user');
        $jaringan=JaringanOpd::findOrFail($id);
        $semua_opd 	= RefOPD::all();
		$semua_alat = RefAlat::all();
		
        return view('jaringan-opd.edit',compact('jaringan', 'semua_opd', 'semua_alat'));
    }
	
	public function update(Request $request, $id)
    {
        //$this->authorize('kelola-user');
		$request->validate([
            "id_opd"	=> "required",
            "id_alat" 	=> "required",
            "kondisi" 	=> "required",
            "kode_alat" => "required"
            
        ]);
		
		$jaringan=JaringanOpd::findOrFail($id);
		        
		$jaringan->id_opd=$request->id_opd;
		$jaringan->id_alat=$request->id_alat;
		$jaringan->kondisi=$request->kondisi;
		$jaringan->tgl_pemasangan = Carbon::create($request->tgl_pemasangan); 
		$jaringan->kode_alat=$request->kode_alat;
		
		if ($request->hasFile('file')) {

            // hapus foto lama
            \Storage::delete("public/".$jaringan->foto);

            // simpan foto baru
            $path = $request->file('file')->store("/jaringan-opd/", 'public');

            $jaringan->foto = $path;
        }
		
        $jaringan->save();
		//return response()->json(['data' => $user]);
        return redirect()->to('jaringan-opd')->with('message','Berhasil update data Jaringan');
    }
	
	public function destroy($id)
    {
       // $this->authorize('kelola-user');
        $jaringan=JaringanOpd::findOrFail($id);
        $jaringan->delete();
        return redirect()->to('jaringan-opd')->with('message','Berhasil hapus data Jaringan');
    }
	
	public function processImport(Request $request)
	{
		$request->validate([
			"file" => "required|file|mimes:xls,xlsx|max:10000"
		]);

		Excel::import(new JaringanOpdImport, $request->file);
		//return response()->json(['data' => $request]);
		return redirect()->to('jaringan-opd')->with('message', 'Data Jaringan OPD berhasil diimport');
	}
	
	//untuk EKSPORT ke file excel
	public function processExport()
	{		
		return Excel::download(new JaringanOpdExport, 'jaringanOpd.xlsx');
	}
}
