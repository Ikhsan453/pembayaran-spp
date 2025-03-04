<?php

namespace App\Http\Controllers;


use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pembayaran = Pembayaran::with('siswa', 'spp')->paginate(5);
        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data = Pembayaran::all();
        $pdf = Pdf::loadView('admin.pembayaran.invoice', compact('data'));
        return $pdf->download('invoice.pdf');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'siswa_id' => 'required',
            'tanggal_bayar' => 'required',
            'bulan' => 'required',
            'spp_id' => 'required',
            'nama_pengimput' => 'required',
        ]);        

        $pembayaran = Pembayaran::create([
            'siswa_id' => $request->input('siswa_id'),
            'tanggal_bayar' => $request->input('tanggal_bayar'),
            'bulan' => $request->input('bulan'),
            'spp_id' => $request->input('spp_id'),
            'nama_pengimput' => $request->input('nama_pengimput'),
        ]);

        if($pembayaran) {
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
        $pembayaran = Pembayaran::where('siswa_id', $id)->paginate(10);
        return view('admin.pembayaran.show', compact('pembayaran'));
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
