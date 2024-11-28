<!-- @extends('layouts.main')-->

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
                        <th scope="col">#/th>
                        <th scope="col">NIS | NISN</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">No HP</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      @forelse($siswa as $no => $w)
                        <tr>
                          <th scope="row">{{ $siswa->firstItem() + $no }}</th>
                          <td>{{ $w->nis }} | {{ $w->nisn }}</td>
                          <td>{{ $w->nama }}</td>
                          <td>{{ $w->kelas->nama_kelas }}</td>
                          <td>{{ $w->no_telp }}</td>
                          <td class="">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#edit{{$w->id}}" class="btn btn-secondary btn-sm" >Edit</a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#lihat{{$w->id}}" class="btn btn-warning btn-sm" >Lihat</a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#delete{{$w->id}}" class="btn btn-danger btn-sm">Hapus</a><br>
                            <div class="dropdown mt-1">
                              <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Status
                              </button>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">riwayat</a></li>
                                <li><a class="dropdown-item" href="#" role="button" data-bs-toggle="modal" data-bs-target="#bayar{{$w->id}}">bayar</a></li>
                                </ul>
                            </div>
                          </td>
                        </tr>
                        @empty
                          <div class="alert alert-primary d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div>
                              Data Siswa Belum Ada
                            </div>
                          </div>
                        </tr>
                        @endforelse 
                    </tbody>
                  </table>
                  <div class="d-flex justify-content-between align-items-center btn btn-sm">
                      <div>
                          Showing <b>{{ $siswa->firstItem() }}</b> to <b>{{ $siswa->lastItem() }}</b> of <b>{{ $siswa->total() }}</b> results
                      </div>
                      <div>
                          {{ $siswa->links() }}
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
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Siswa</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('siswa.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label">Nis</label>
              <input type="number" 
                class="form-control @error('nis')
              is-invalid
              @enderror" name="nis" placeholder="Masukkan Nis Dengan Benar">
                @error('nis')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
            
            <div class="mb-3">
              <label class="form-label">Nisn</label>
              <input type="number" class="form-control @error('nisn')
              is-invalid
              @enderror" name="nisn" placeholder="Masukkan Nisn Dengan Benar">
                @error('nisn')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input type="text" class="form-control @error('nama')
              is-invalid
              @enderror" name="nama" placeholder="Masukkan Nama Dengan Benar">
                @error('nama')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Kelas</label>
              <select class="form-select @error('kelas_id')
              is-invalid
              @enderror" name="kelas_id" aria-label="Pilih Kelas">
                <option selected>Open this select menu</option>
                @foreach($kelas as $k)
                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                @endforeach
                
              </select>
                @error('kelas_id')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Alamat</label>
              <textarea class="form-control @error('alamat')
              is-invalid
              @enderror" name="alamat" rows="3"></textarea>
                @error('alamat')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">no telp</label>
              <input type="number" 
                class="form-control @error('no_telp')
              is-invalid
              @enderror" name="no_telp" placeholder="Masukkan no telp Dengan Benar">
                @error('no_telp')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">SPP</label>
              <select class="form-select @error('spp_id')
              is-invalid
              @enderror" name="spp_id" aria-label="Pilih Masa SPP">
              <option selected>Open this select menu</option>
              @foreach($spp as $s)
                <option value="{{ $w->id }}">{{ $s->tahun }}</option>
                @endforeach
              </select>
                @error('spp_id')
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


  @foreach($siswa as $w)
     <!-- Modal Edit -->
  <div class="modal fade" id="edit{{$w->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Siswa</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('siswa.update', $w->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label class="form-label">Nis</label>
              <input type="number" 
                class="form-control @error('nis')
              is-invalid
              @enderror" name="nis" value="{{old('nis', $w->nis)}}" placeholder="Masukkan Nis Dengan Benar" readonly>
                @error('nis')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Nisn</label>
              <input type="number" class="form-control @error('nisn')
              is-invalid
              @enderror" name="nisn" value="{{old('nisn', $w->nisn)}}" placeholder="Masukkan Nisn Dengan Benar" readonly>
                @error('nisn')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input type="text" class="form-control @error('nama')
              is-invalid
              @enderror" name="nama" value="{{old('nama', $w->nama)}}" placeholder="Masukkan Nama Dengan Benar">
                @error('nama')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Kelas</label>
              <select class="form-select @error('kelas_id')
              is-invalid
              @enderror" name="kelas_id" aria-label="Pilih Kelas">
                <option selected>{{ $k->kelas_id  }}</option>
                @foreach($kelas as $k)
                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                @endforeach
              </select>
                @error('kelas_id')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Alamat</label>
              <textarea class="form-control @error('alamat')
              is-invalid
              @enderror" name="alamat" rows="3">{{ $w->alamat }}</textarea>
                @error('alamat')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">no telp</label>
              <input type="number" 
                class="form-control @error('no_telp')
              is-invalid
              @enderror" name="no_telp" value="{{old('no_telp', $w->no_telp)}}" placeholder="Masukkan no telp Dengan Benar">
                @error('no_telp')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">SPP</label>
              <select class="form-select @error('spp_id')
              is-invalid
              @enderror" name="spp_id" aria-label="Pilih Masa SPP">
              <option selected>{{ $s->spp_id  }}</option>
              @foreach($spp as $s)
                <option value="{{ $s->id }}">{{ $s->tahun }}</option>
                @endforeach
              </select>
                @error('spp_id')
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

  @foreach($siswa as $w)
     <!-- Modal Tampil -->
  <div class="modal fade" id="lihat{{$w->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data Siswa</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body btn">
          <p>NIS | NISN : {{ $w->nis }} | {{ $w->nisn }}</p>
          <p>Nama Siswa : {{ $w->nama }}</p>
          <p>Alamat : {{ $w->alamat }}</p>
          <p>No HP : {{ $w->no_telp }}</p>
          <p>Kelas : {{ $w->Kelas->nama_kelas }}</p>
          <p>Tahun SPP : {{ $w->Spp->tahun }}</p>
          <p>Nominal SPP : <span class="btn btn-danger">{{ 'Rp. ' . number_format($w->Spp->nominal, 2, ',', '.') }}</span> </p>
        </div>
      </div>
    </div>
  </div>
  @endforeach

  @foreach($siswa as $w)
     <!-- Modal Delete -->
  <div class="modal fade" id="delete{{ $w->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Siswa</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda Yakin Ingin Menghapus Data <b>{{ $w->nama }}</b></p>
        </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">keluar</button>
              <form action="{{ route('kelas.destroy', $w->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">hapus</button>
              </form>

              
            </div>
      </div>
    </div>
  </div>
  @endforeach

  @foreach($siswa as $w)
     <!-- Modal Bayar -->
  <div class="modal fade" id="bayar{{$w->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Siswa</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('pembayaran.store') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input type="text" class="form-control @error('nama')
              is-invalid
              @enderror" name="nama" value="{{old('nama', $w->nama)}}" placeholder="Masukkan Nama Dengan Benar" readonly>
            </div>
            <div class="mb-3">
              <input type="text" class="form-control @error('siswa_id')
              is-invalid
              @enderror" name="siswa_id" value="{{old('siswa_id', $w->siswa_id)}}" placeholder="Masukkan Siswa Dengan Benar" hidden>
                @error('siswa_id')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Nis</label>
              <input type="number" 
                class="form-control @error('nis')
              is-invalid
              @enderror" name="nis" value="{{old('nis', $w->nis)}}" placeholder="Masukkan Nis Dengan Benar" readonly>
                @error('nis')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Nisn</label>
              <input type="number" class="form-control @error('nisn')
              is-invalid
              @enderror" name="nisn" value="{{old('nisn', $w->nisn)}}" placeholder="Masukkan Nisn Dengan Benar" readonly>
                @error('nisn')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
            
            <div class="mb-3">
              <label class="form-label">Kelas</label>
              <select class="form-select @error('kelas_id')
              is-invalid
              @enderror" name="kelas_id" aria-label="Pilih Kelas">
                <option selected>{{ $w->kelas_id  }}</option>
                @foreach($kelas as $k)
                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                @endforeach
                
              </select>
                @error('kelas_id')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Alamat</label>
              <textarea class="form-control @error('alamat')
              is-invalid
              @enderror" name="alamat" rows="3">{{ $w->alamat }}</textarea>
                @error('alamat')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">no telp</label>
              <input type="number" 
                class="form-control @error('no_telp')
              is-invalid
              @enderror" name="no_telp" value="{{old('no_telp', $w->no_telp)}}" placeholder="Masukkan no telp Dengan Benar">
                @error('no_telp')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">SPP</label>
              <select class="form-select @error('spp_id')
              is-invalid
              @enderror" name="spp_id" aria-label="Pilih Masa SPP">
              <option selected>{{ $w->spp_id  }}</option>
              @foreach($spp as $s)
                <option value="{{ $s->id }}">{{ $s->tahun }}</option>
                @endforeach
              </select>
                @error('spp_id')
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

@endpush