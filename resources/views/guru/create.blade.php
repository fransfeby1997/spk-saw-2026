@extends('layouts.main')

@section('judul', 'Tambah Data Pegawai')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg">
                <div class="card mt-4">
                    <div class="container">
                        <form class="form-control mt-4 mb-4" action="{{ url('/guru') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                                    id="nip" value="{{ old('nip') }}">
                            </div>
                            @error('nip')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pegawai</label>
                                <input type="text" name="nama_guru"
                                    class="form-control @error('nama_guru') is-invalid @enderror" id="nama" value="{{ old('nama_guru') }}">
                            </div>
                            @error('nama_guru')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir"
                                    class="form-control" id="tgl_lahir" value="{{ old('tgl_lahir') }}">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="jenis_kelamin" aria-label="Default select example">
                                    <option value="Laki Laki">Laki Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Jabatan</label>
                                <input type="text" name="jabatan"
                                    class="form-control" id="jabatan" value="{{ old('jabatan') }}">
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat"
                                    class="form-control" id="alamat" value="{{ old('alamat') }}">
                            </div>

                            <br>
                            <a href="{{ url('/guru') }}" class="btn btn-secondary"><i
                                    class="ri-arrow-go-back-line"></i><span> Batal</span></a>
                            <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i><span>
                                    Simpan</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

        </div>
        </div>
    </section>
@endsection
