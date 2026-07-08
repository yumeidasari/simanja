<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (\Gate::denies('ADMIN')) {
                abort(403, 'Hanya admin yang boleh mengelola data pegawai.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $semua_pegawai = Pegawai::orderBy('nama', 'asc')->paginate(10);
        return view('pegawai.index', compact('semua_pegawai'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required',
            'nip'    => 'required|max:20',
            'bidang' => 'required|in:Sekretariat,Aplikasi Informatika, Informasi dan Komunikasi Publik,Keamanan Informasi, Persandian, dan Statistik',
        ]);

        $pegawai = new Pegawai;
        $pegawai->nama = $request->nama;
        $pegawai->nip = $request->nip;
        $pegawai->bidang = $request->bidang;
        $pegawai->save();

        return redirect()->to('pegawai')->with('message', 'Berhasil menambah Data Pegawai');
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'   => 'required',
            'nip'    => 'required|max:20',
            'bidang' => 'required|in:Sekretariat,IKP,KIPS,APTIKA',
        ]);

        $pegawai = Pegawai::findOrFail($id);
        $pegawai->nama = $request->nama;
        $pegawai->nip = $request->nip;
        $pegawai->bidang = $request->bidang;
        $pegawai->save();

        return redirect()->to('pegawai')->with('message', 'Berhasil update Data Pegawai');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->to('pegawai')->with('message', 'Berhasil hapus Data Pegawai');
    }
}