<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    private $daftarBidang = [
        'Sekretariat',
        'Bidang Aplikasi Informatika',
        'Bidang Informasi Dan Komunikasi Publik',
        'Bidang Keamanan Informasi, Persandian Dan Statistik',
    ];

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
        $daftarBidang = $this->daftarBidang;
        return view('pegawai.create', compact('daftarBidang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required',
            'nip'    => 'required|max:20',
            'bidang' => ['required', Rule::in($this->daftarBidang)],
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
        $daftarBidang = $this->daftarBidang;
        return view('pegawai.edit', compact('pegawai', 'daftarBidang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'   => 'required',
            'nip'    => 'required|max:20',
            'bidang' => ['required', Rule::in($this->daftarBidang)],
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