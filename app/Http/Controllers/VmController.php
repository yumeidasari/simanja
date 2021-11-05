<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vm;
use App\Models\RefAlat;
use App\Imports\VmImport;
use App\Exports\VmExport;
use Excel;
use Illuminate\Support\Facades\DB;

class VmController extends Controller
{
    //public function index()
	public function index(Request $request)
    {
		//$semua_vm = Vm::orderBy('id','DESC')->paginate(5);
		//$semua_vm = Vm::sortable()->paginate(5);
		$cari = $request->get('search');

        $semua_vm = DB::table('virtual_machine')
						->join('ref_alat', 'virtual_machine.id_alat', '=', 'ref_alat.id')
                        ->select('virtual_machine.*','ref_alat.nama_alat', 'ref_alat.tipe', 'ref_alat.model')
                        ->where('virtual_machine.server_vm', 'LIKE', '%'.$cari.'%')
						->orwhere('ref_alat.tipe', 'LIKE', '%'.$cari.'%')
						->orwhere('virtual_machine.ip_vm', 'LIKE', '%'.$cari.'%')
						->orwhere('virtual_machine.os_vm', 'LIKE', '%'.$cari.'%')
						->orwhere('virtual_machine.nama_vm', 'LIKE', '%'.$cari.'%')
						->orderby('virtual_machine.id','desc')
                        ->paginate(5);
						
		$semua_alat = RefAlat::all();
		
        return view('vm.index', compact('semua_vm', 'semua_alat'));
        //return view('users.index', ['users' => $model->paginate(15)]);
    }
	
	public function store(Request $request)
    {
        //$this->authorize('kelola-user');
		$request->validate([
            "id_alat" 	=> "required",
            "nama_vm" 	=> "required",
            "ip_vm" 	=> "required",
			"os_vm" 	=> "required",
            "server_vm" => "required"
        ]);
		
        $vm = new Vm;  //--->> new Nama MOdel!!!!
		$vm->id_alat = $request->id_alat;
		$vm->nama_vm = $request->nama_vm;
		$vm->ip_vm = $request->ip_vm;
		$vm->os_vm = $request->os_vm;
		$vm->server_vm = $request->server_vm;
		
		$vm->save();
        
		//return response()->json(['data' => $user]);
        return redirect()->to('vm')->with('message','Berhasil menambah Data Virtual Mesin');
    }
	
	public function update(Request $request, $id)
    {
        //$this->authorize('kelola-user');
		$request->validate([
            "id_alat" 	=> "required",
            "nama_vm" 	=> "required",
            "ip_vm" 	=> "required",
			"os_vm" 	=> "required",
            "server_vm" => "required"
        ]);
		
		$vm=Vm::findOrFail($id);
		        
		$vm->id_alat = $request->id_alat;
		$vm->nama_vm = $request->nama_vm;
		$vm->ip_vm = $request->ip_vm;
		$vm->os_vm = $request->os_vm;
		$vm->server_vm = $request->server_vm;
		
		$vm->save();
		//return response()->json(['data' => $user]);
        return redirect()->to('vm')->with('message','Berhasil update data VM');
    }
	
	public function destroy($id)
    {
       // $this->authorize('kelola-user');
        $vm=Vm::findOrFail($id);
        $vm->delete();
        return redirect()->to('vm')->with('message','Berhasil hapus data VM');
    }
	
	public function processImport(Request $request)
	{
		$request->validate([
			"file" => "required|file|mimes:xls,xlsx|max:10000"
		]);

		Excel::import(new VmImport, $request->file);
		//return response()->json(['data' => $request]);
		return redirect()->to('vm')->with('message', 'Data Jaringan VM berhasil diimport');
	}
	
	//untuk EKSPORT ke file excel
	public function processExport()
	{		
		return Excel::download(new VmExport, 'vmware.xlsx');
	}
}
