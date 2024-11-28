<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $spp = Spp::paginate(5);
        return view('admin.spp.index', compact('spp'));
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
            'tahun' => 'required',
            'nominal' => 'required',
        ]);        

        $spp = Spp::create([
            'tahun' => $request->input('tahun'),
            'nominal' => $request->input('nominal')
        ]);

        if($spp) {
            return redirect()->route('spp.index')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('spp.index')->with(['error' => 'Data Gagal Disimpan']);
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
        //
        $this->validate($request, [
            'tahun' => 'required',
            'nominal' => 'required',
        ]);

        $spp = Spp::findOrFail($id);
        $spp->update([
            'tahun' => $request->input('tahun'),
            'nominal' => $request->input('nominal')
        ]);

        if($spp) {
            return redirect()->route('spp.index')->with(['update' => 'Data Berhasil Diupdate']);
        } else {
            return redirect()->route('spp.index')->with(['error' => 'Data Gagal Diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $spp = Spp::findOrFail($id);
        $spp->delete();

        if($spp) {
            return redirect()->route('spp.index')->with(['delete' => 'Data Berhasil Didelete']);
        } else {
            return redirect()->route('spp.index')->with(['error' => 'Data Gagal Dihapus']);
        }
    }
}
