<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $siswa = Siswa::with('kelas', 'spp')->paginate(5);
        $kelas = Kelas::all();
        $spp = SPP::all();
        return view('admin.siswa.index', compact('siswa', 'kelas', 'spp'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'nis' => 'required|unique:siswas,nis',
            'nisn' => 'required|unique:siswas,nisn',
            'nama' => 'required',
            'kelas_id' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'spp_id' => 'required',
        ]);        

        $siswa = Siswa::create([
            'nis' => $request->input('nis'),
            'nisn' => $request->input('nisn'),
            'nama' => $request->input('nama'),
            'kelas_id' => $request->input('kelas_id'),
            'alamat' => $request->input('alamat'),
            'no_telp' => $request->input('no_telp'),
            'spp_id' => $request->input('spp_id'),
        ]);

        if($siswa) {
            return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('siswa.index')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $siswa)
    {
        //
        $this->validate($request, [
            'nis' => 'required',
            'nisn' => 'required',
            'nama' => 'required',
            'kelas_id' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required', 
            'spp_id' => 'required',
        ]);

        $siswa = Siswa::findOrFail($siswa);
        $siswa->update([
            'nis' => $request->input('nis'),
            'nisn' => $request->input('nisn'),
            'nama' => $request->input('nama'),
            'kelas_id' => $request->input('kelas_id'),
            'alamat' => $request->input('alamat'),
            'no_telp' => $request->input('no_telp'),
            'spp_id' => $request->input('spp_id'),
        ]);

        if($siswa) {
            return redirect()->route('siswa.index')->with(['update' => 'Data Berhasil Diupdate']);
        } else {
            return redirect()->route('siswa.index')->with(['error' => 'Data Gagal Diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        if($siswa) {
            return redirect()->route('siswa.index')->with(['delete' => 'Data Berhasil Didelete']);
        } else {
            return redirect()->route('siswa.index')->with(['error' => 'Data Gagal Dihapus']);
        }
    }
}
