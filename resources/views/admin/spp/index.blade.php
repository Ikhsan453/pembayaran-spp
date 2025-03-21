@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>{{ $message }}</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      @if ($message = Session::get('update'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
          <strong>{{ $message }}</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      @if ($message = Session::get('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>{{ $message }}</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="#"  data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-success btn-sm">Tambah Data</a>
                </div>

                <div class="card-body">
                 <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tahun</th>
                        <th scope="col">Nominal</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      @forelse($spp as $no => $s)
                        <tr>
                          <th scope="row">{{ ++$no }}</th>
                          <td>{{ $s->tahun }}</td>
                          <td>{{ 'Rp. ' . number_format($s->nominal, 2, ',', '.') }}</td>
                          <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#edit{{$s->id}}" class="btn btn-secondary btn-sm" >Edit</a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#delete{{$s->id}}" class="btn btn-danger btn-sm">Hapus</a>
                          </td>
                        @empty
                          <div class="alert alert-primary d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div>
                              Data SPP Belum Ada
                            </div>
                          </div>
                        </tr>
                      @endforelse 
                    </tbody>
                  </table>
                  <div class="d-flex justify-content-between align-items-center btn btn-sm">
                      <div>
                          Showing <b>{{ $spp->firstItem() }}</b> to <b>{{ $spp->lastItem() }}</b> of <b>{{ $spp->total() }}</b> results
                      </div>
                      <div>
                          {{ $spp->links() }}
                      </div>
                  </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')
  <!-- Modal -->
  <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data SPP</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('spp.store') }}" method="POST">
            @csrf
            @method('POST')
            <div class="mb-3">
              <label class="form-label">Tahun</label>
              <input type="number" 
                class="form-control @error('tahun')
              is-invalid
              @enderror" name="tahun" placeholder="Masukkan Tahun Dengan Benar">
                @error('tahun')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Nominal</label>
              <input type="number" class="form-control @error('nominal')
              is-invalid
              @enderror" name="nominal" placeholder="Masukkan Nominal Dengan Benar">
                @error('nominal')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>

            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">keluar</button>
              <button type="submit" class="btn btn-success btn-sm">simpan</button>
            </div>

          </form>
        </div>
        
      </div>
    </div>
  </div>

  @foreach($spp as $s)
     <!-- Modal Edit -->
  <div class="modal fade" id="edit{{$s->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data SPP</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('spp.update',$s->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label class="form-label">Tahun</label>
              <input type="number" 
                class="form-control @error('tahun')
              is-invalid
              @enderror" name="tahun" value="{{old('tahun', $s->tahun)}}" placeholder="Masukkan Tahun Dengan Benar">
                @error('tahun')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Nominal</label>
              <input type="number" class="form-control @error('nominal')
              is-invalid
              @enderror" name="nominal" value="{{old('nominal', $s->nominal)}}" placeholder="Masukkan Nominal Dengan Benar">
                @error('nominal')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>

            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">keluar</button>
              <button type="submit" class="btn btn-success btn-sm">simpan</button>
            </div>

          </form>
        </div>
        
      </div>
    </div>
  </div>
  @endforeach

  @foreach($spp as $s)
     <!-- Modal Delete -->
  <div class="modal fade" id="delete{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data SPP</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda Yakin Ingin Menghapus Data <b>{{ $s->tahun }}</b></p>
        </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">keluar</button>
              <form action="{{ route('spp.destroy', $s->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">hapus</button>
              </form>

              
            </div>
      </div>
    </div>
  </div>
  @endforeach

@endpush