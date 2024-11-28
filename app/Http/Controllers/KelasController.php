<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::paginate(5);
        return view('admin.kelas.index', compact('kelas'));
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
        //dd($request->all());
        $this->validate($request, [
            'nama_kelas' => 'required',
            'kompetensi_keahlian' => 'required',
        ]);        

        $kelas = Kelas::create([
            'nama_kelas' => $request->input('nama_kelas'),
            'kompetensi_keahlian' => $request->input('kompetensi_keahlian')
        ]);

        if($kelas) {
            return redirect()->route('kelas.index')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('kelas.index')->with(['error' => 'Data Gagal Disimpan']);
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
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'nama_kelas' => 'required',
            'kompetensi_keahlian' => 'required',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update([
            'nama_kelas' => $request->input('nama_kelas'),
            'kompetensi_keahlian' => $request->input('kompetensi_keahlian')
        ]);

        if($kelas) {
            return redirect()->route('kelas.index')->with(['update' => 'Data Berhasil Diupdate']);
        } else {
            return redirect()->route('kelas.index')->with(['error' => 'Data Gagal Diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        if($kelas) {
            return redirect()->route('kelas.index')->with(['delete' => 'Data Berhasil Didelete']);
        } else {
            return redirect()->route('kelas.index')->with(['error' => 'Data Gagal Dihapus']);
        } 
    }
}
