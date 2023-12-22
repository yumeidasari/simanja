<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsetUmum;
use App\Models\UnitKerja;
use App\Models\LampiranAset;
use App\Models\User;
use Excel;
use Illuminate\Support\Facades\DB;
use Storage;

use RealRashid\SweetAlert\Facades\Alert;

class AsetUmumController extends Controller
{
    public function index(Request $request)
    {
        //$semua_aset = AsetUmum::all();
		$cari = $request->get('search');
		
		//$id_bidang = auth()->user()->id_bidang;
        $semua_aset = DB::table('aset_kantor')
						->join('unit_kerja', 'unit_kerja.id', '=', 'aset_kantor.id_unit_kerja')
						->select('aset_kantor.*', 
								'unit_kerja.nama_unit_kerja as bidang')
						//->where('aset_kantor.id_unit_kerja', '=', auth()->user()->id_bidang)
                        ->where('aset_kantor.nama_aset', 'LIKE', '%'.$cari.'%')
						->orwhere('aset_kantor.merek', 'LIKE', '%'.$cari.'%')
						->orwhere('aset_kantor.jenis_aset', 'LIKE', '%'.$cari.'%')
						->orwhere('unit_kerja.nama_unit_kerja', 'LIKE', '%'.$cari.'%')
						->orderby('aset_kantor.id','desc')
                        ->paginate();
						//return response()->json(['data' => $semua_aset]);
		//$semua_file = LampiranAset::all();				
        return view('aset-umum.index', compact('semua_aset'));       
    }
	
	public function formAset(){
		$data_bidang = UnitKerja::all();
		/**
		$url = 'https://api-splp.layanan.go.id/pegawaidiskominfo/1.0';
        $apikey = 'eyJ4NXQiOiJOVGRtWmpNNFpEazNOalkwWXpjNU1tWm1PRGd3TVRFM01XWXdOREU1TVdSbFpEZzROemM0WkE9PSIsImtpZCI6ImdhdGV3YXlfY2VydGlmaWNhdGVfYWxpYXMiLCJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOiJkaXNrb21pbmZvX2JlbHRpbWthYkBjYXJib24uc3VwZXIiLCJhcHBsaWNhdGlvbiI6eyJvd25lciI6ImRpc2tvbWluZm9fYmVsdGlta2FiIiwidGllclF1b3RhVHlwZSI6bnVsbCwidGllciI6IlVubGltaXRlZCIsIm5hbWUiOiJTSU1BTkpBIiwiaWQiOjI3MjEsInV1aWQiOiI4MzhlZGI0YS01OGQ1LTQ4ZWYtYmY5Zi05YzI2ODE3NWZjYWMifSwiaXNzIjoiaHR0cHM6XC9cL3NwbHAubGF5YW5hbi5nby5pZDo0NDNcL29hdXRoMlwvdG9rZW4iLCJ0aWVySW5mbyI6eyJVbmxpbWl0ZWQiOnsidGllclF1b3RhVHlwZSI6InJlcXVlc3RDb3VudCIsImdyYXBoUUxNYXhDb21wbGV4aXR5IjowLCJncmFwaFFMTWF4RGVwdGgiOjAsInN0b3BPblF1b3RhUmVhY2giOmZhbHNlLCJzcGlrZUFycmVzdExpbWl0IjoxMDAwMDAsInNwaWtlQXJyZXN0VW5pdCI6InNlYyJ9fSwia2V5dHlwZSI6IlBST0RVQ1RJT04iLCJwZXJtaXR0ZWRSZWZlcmVyIjoiIiwic3Vic2NyaWJlZEFQSXMiOlt7InN1YnNjcmliZXJUZW5hbnREb21haW4iOiJjYXJib24uc3VwZXIiLCJuYW1lIjoiUGVnYXdhaV9EaXNrb21pbmZvU1AiLCJjb250ZXh0IjoiXC9wZWdhd2FpZGlza29taW5mb3NwXC8xLjAiLCJwdWJsaXNoZXIiOiJkaXNrb21pbmZvX2JlbHRpbWthYiIsInZlcnNpb24iOiIxLjAiLCJzdWJzY3JpcHRpb25UaWVyIjoiVW5saW1pdGVkIn1dLCJ0b2tlbl90eXBlIjoiYXBpS2V5IiwicGVybWl0dGVkSVAiOiIiLCJpYXQiOjE3MDI0MzgxMjIsImp0aSI6IjEzN2ZjYTlmLWU1OGUtNDI0Ni1iMzQ4LTM4MDg0YTg0OGE0ZCJ9.tNScscmMysE8AFy5CUjt5Lj80ti1clSHaAgB3VBKw6XyPg-hsIZNxhRT8zP0oHSnsKyysyBV865RgGSlNwSv31bRRGbS6LNn3nVZFDvxcYLqWSJ4XP0Xx4EFY1CY-nt3Z4s64AA0lxE9nGD5Bemybxk13mEIir2x85HQZQ7-uL9BHP3-TE2R_blBiTPQpEtbC8xQsBUxHHqg0oW2D-2VK_dBcJKb3vZdKojft_kbYHnQWKL3UcdZzyZcoofEnqxI0FblVWW26mpiGZXEIgBwcpaCDf5VwC3-v4I7R9HGvCFulhQChMiSH4brdY2ZVsjeJhEGbOaKhqd11gGLZxynqw==';
        $endpoint = $url . '/silagak/pegawai';
        $response = Http::withHeaders([
            'apikey' => $apikey,
            'X-Authorization' => 'kzBQMLr7n36Rdwkc9tYWBQX21jwB0jkXihptCuLzmYCaz1tRw7H8Kr5naJmWMNJ5'
        ])->get($endpoint);
		**/
        //$data = json_decode($response, TRUE);
		
		//return response()->json(['data' => $endpoint]);
		return view('form-aset', compact('data_bidang'));
	}
	
	public function store(Request $request)
    {
		if ($request->hasFile('file')) {
			$request->validate([

				'file[]' => 'mimes:png,jpg,jpeg|max:5120'
			]);
		}
		       
		
        $aset = new AsetUmum;  
        $aset->nama_aset = $request->nama_barang;
		$aset->penanggung_jawab =$request->penanggung_jawab;
		$aset->nip = $request->nip;
		$aset->kondisi_aset = $request->kondisi_barang;
		$aset->jenis_aset = $request->jenis_barang;
		$aset->merek = $request->merek;
		$aset->deskripsi = $request->deskripsi;
		$aset->id_unit_kerja = $request->id_unit_kerja;
		$aset->thn_pengadaan = $request->thn_pengadaan;
		//$aset->createdBy = 0;
        $aset->save();
		//Jika ada lampiran
				
		if ($request->hasFile('file')) {
			$dlampiran = new LampiranAset;
			//return response()->json(['data' => $request->file]);
			foreach ($request->file('file') as $file) {
				$path = $file->store("/lampiran/", 'public');

				$dlampiran->file_lampiran = $path;
				$dlampiran->id_aset_kantor = $aset->id;
				//$dlampiran->createdBy = auth()->user()->id;

				$dlampiran->save();
			}
		}
		alert()->success('Berhasil!', 'Data Aset berhasil disimpan');
		return back();
		
		//return response()->json(['data' => $aset]);
        //return redirect()->to('form-aset')->with('message','Berhasil menambah Data Peralatan Jaringan');
    }
	
	public function destroy($id)
    {
       // $this->authorize('kelola-user');
        $aset = AsetUmum::findOrFail($id);
		
		// periksa lampiran
		$lampiran = LampiranAset::where('id_aset_kantor', $id)->get();
		
		if(count($lampiran) > 0){
			foreach($lampiran as $l){
				if(Storage::exists('public/' . $l->file_lampiran)){
					Storage::delete('public/' . $l->file_lampiran);
					$l->delete();
					
				} else {
					$l->delete();
				}        
			}
		}
        $aset->delete();
		alert()->success('Berhasil!', 'Data Aset berhasil dihapus');
		return back();
        //return redirect()->to('aset-umum')->with('message','Berhasil hapus data Aset Umum');
    }
	
	public function detailAsetUmum($id){
		$data = DB::table('aset_kantor')
						->join('unit_kerja', 'unit_kerja.id', '=', 'aset_kantor.id_unit_kerja')
						->select('aset_kantor.*', 
								'unit_kerja.nama_unit_kerja as bidang')
                        ->where('aset_kantor.id', '=', $id)
                        ->paginate();
		$id_aset = $data[0];
		$gambar = LampiranAset::all();
		$data_bidang = UnitKerja::all();
		//return response()->json(['data' => count($gambar)]);
		return view('aset-umum.detail', compact('data', 'gambar', 'data_bidang', 'id_aset'));
	}
	
	public function updateAsetUmum(Request $request, $id){
		$aset = AsetUmum::findOrFail($id);
		$aset->nama_aset = $request->nama_barang;
		$aset->penanggung_jawab =$request->penanggung_jawab;
		$aset->nip = $request->nip;
		$aset->kondisi_aset = $request->kondisi_barang;
		$aset->jenis_aset = $request->jenis_barang;
		$aset->merek = $request->merek;
		$aset->deskripsi = $request->deskripsi;
		$aset->id_unit_kerja = $request->id_unit_kerja;
		$aset->thn_pengadaan = $request->thn_pengadaan;
		
		$aset->save();

		if ($request->hasFile('file')) {
			$dlampiran = new LampiranAset;
			//return response()->json(['data' => $request->file]);
			foreach ($request->file('file') as $file) {
				$path = $file->store("/lampiran/", 'public');

				$dlampiran->file_lampiran = $path;
				$dlampiran->id_aset_kantor = $aset->id;
				//$dlampiran->createdBy = auth()->user()->id;

				$dlampiran->save();
			}
		}
		
		alert()->success('Berhasil!', 'Data Aset berhasil diubah');
		return back();
	}
	
}
