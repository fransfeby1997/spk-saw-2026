@extends('layouts.main')

@section('judul', 'Input Penilaian Pegawai')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Skala Nilai</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Skala Nilai</th>
                                    <th>Keterangan</th>
                                    <th>Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1-20</td>
                                    <td>Sangat Rendah</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>21-40</td>
                                    <td>Rendah</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>41-60</td>
                                    <td>Cukup</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>61-80</td>
                                    <td>Baik</td>
                                    <td>4</td>
                                </tr>
                                <tr>
                                    <td>81-100</td>
                                    <td>Sangat Baik</td>
                                    <td>5</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="container mb-4">
                        <form action="{{ route('penilaian.store') }}" method="post">
                            @csrf
                            <div class="mt-4 mb-3 mx-4">
                                <label for="periode" class="form-label">Input Periode</label>
                                <input type="text" name="periode"
                                    class="form-control @error('periode') is-invalid @enderror" id="periode"
                                    value="{{ old('periode') }}">
                            </div>
                            <table class="table mt-4 ">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th scope="coll">Nama Pegawai</th>
                                        @foreach ($dataKriteria as $kriteria)
                                            <th scope="coll">{{ $kriteria->nama_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataGuru as $guru)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $guru->nama_guru }}</td>
                                            @foreach ($dataKriteria as $kriteria)
                                                <td>
                                                    <input type="hidden" name="jenis_kriteria[{{ $kriteria->id }}]"
                                                        value="{{ $kriteria->jenis_kriteria }}">
                                                    <select name="nilai[{{ $guru->id }}][{{ $kriteria->id }}]" class="form-select">
                                                        <option value="" selected></option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary float-end">Hitung Nilai</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection