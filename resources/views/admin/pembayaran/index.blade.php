@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="mt-1 mb-1">
            <a href="{{ route('pembayaran.create')}}" class="btn btn-danger btn-sm">Export</a>
          </div>
            <div class="card">
                <div class="card-header">
                  <marquee behavior="left" direction="left">Rekapitulasi Pembayaran SPP</marquee>
                </div>

                <div class="card-body">
                 <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Tanggal Bayar</th>
                        <th scope="col">Bulan</th>
                        <th scope="col">Tahun || Nominal</th>
                        <th scope="col">Admin</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      @forelse($pembayaran as $no => $p)
                        <tr>
                          <th scope="row">{{ ++$no }}</th>
                          <td>{{ $p->siswa->nama }}</td>
                          <td>{{ $p->tanggal_bayar }}</td>
                          <td>{{ $p->bulan }}</td>
                          <td>{{ $p->spp->tahun }} || {{ 'Rp. ' . number_format($p->spp->nominal, 2, ',', '.') }}</td>
                          <td>{{ $p->nama_pengimput }}</td>
                        @empty
                          <div class="alert alert-primary d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div>
                              Data Pembayaran Belum Ada
                            </div>
                          </div>
                        </tr>
                      @endforelse 
                    </tbody>
                  </table>
                  <div class="d-flex justify-content-between align-items-center btn btn-sm">
                      <div>
                          Showing <b>{{ $pembayaran->firstItem() }}</b> to <b>{{ $pembayaran->lastItem() }}</b> of <b>{{ $pembayaran->total() }}</b> results
                      </div>
                      <div>
                          {{ $pembayaran->links() }}
                      </div>
                  </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
