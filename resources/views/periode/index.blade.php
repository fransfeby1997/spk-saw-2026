@extends('layouts.main')

@section('judul', 'Data Periode')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg">
                <div class="card">
                    <div class="mt-4 mb-3 mx-4">
                        <!-- Form untuk memilih periode -->
                        <form method="GET" action="{{ route('periode.index') }}">
                            <label for="periodeSelect">Pilih Periode Penilaian:</label>
                            <select class="form-select" id="periodeSelect" name="periode" onchange="this.form.submit()">
                                @foreach ($allPeriode as $periode)
                                    <option value="{{ $periode }}" {{ $selectedPeriode == $periode ? 'selected' : '' }}>
                                        {{ $periode }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="card-body">
                        <!-- Default Table -->
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Periode</th>
                                    <th scope="col">Nama Pegawai</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>


                            <tbody id="periodeTable">

                                @foreach ($data as $periode)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ preg_replace('/[^0-9]/', '', $periode->periode) }}</td>

                                        <td>{{ $periode->guru->nama_guru ?? 'Tidak Ditemukan' }}</td>

                                        <td>{{ number_format($periode->nilai_terbobot, 2)}}</td>
                                        <td>
                                            <a href="{{ route('cetak.hasil.penilaian', ['guru_id' => $periode->guru_id, 'periode' => $periode->periode]) }}"
                                                class="btn btn-success btn-sm" target="_blank">
                                                <i class="bi bi-printer"></i> Cetak
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>



    </section>

@endsection