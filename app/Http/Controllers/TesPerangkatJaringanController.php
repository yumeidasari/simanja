<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RefOPD;
use App\Models\RefAlat;
use App\Models\JaringanOpd;
use App\Imports\OpdImport;
use App\Exports\OpdExport;
use Excel;
use Illuminate\Support\Facades\DB;


class TesPerangkatJaringanController extends Controller
{
    //
	public function index(Request $request)
    {
		$cari = $request->get('search');

        $semua_opd = DB::table('ref_opd')
                        ->select('ref_opd.*')
                        ->where('ref_opd.nama_opd', 'LIKE', '%'.$cari.'%')
						->orderby('ref_opd.nama_opd','asc')
                        ->paginate(5);
		
		$opd 	= RefOPD::all();
		 
		$total_opd = count($opd);
		
		if($total_opd != 0)
		{
			for($i=0; $i < $total_opd; $i++)
			{
				$alat = DB::table('jaringan_opd')
						->select('jaringan_opd.*')
						->where('jaringan_opd.id_opd', '=', $opd[$i]->id)
						->get();
						
				$jml_alat = count($alat);
				
				$opd[$i]->total_alat = $jml_alat;
				$opd[$i]->save();
			}
		}
		
		$perangkat  = DB::table('jaringan_opd')
						->join('ref_opd', 'jaringan_opd.id_opd', '=', 'ref_opd.id')
						->join('ref_alat', 'jaringan_opd.id_alat', '=', 'ref_alat.id')
                        ->select('ref_alat.nama_alat', 'ref_alat.tipe','ref_alat.model', 
								'jaringan_opd.*')
						->orderby('ref_alat.nama_alat','asc')
                        ->get();
        return view('perangkat-jaringan-tes.index', compact('semua_opd', 'opd', 'perangkat'));
       
    }
	
	public function destroy($id)
    {
       // $this->authorize('kelola-user');
        $jaringan=JaringanOpd::findOrFail($id);
        $jaringan->delete();
        return redirect()->to('perangkat-jaringan-tes')->with('message','Berhasil hapus data Perangkat');
    }
	
}
