<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use App\Models\NilaiTerbobot;

class PenilaianController extends Controller
{
    public function index()
    {
        $dataGuru = Guru::with([
            'penilaian' => function ($query) {
                $query->where('periode', date('Y'));
            },
            'penilaian.kriteria'
        ])->get();

        $allGuru = Guru::all();
        $dataKriteria = Kriteria::all();

        return view('penilaian.index', compact('dataGuru', 'allGuru', 'dataKriteria'));
    }

    public function hitungMatriksNormalisasi($matriksNilai)
    {
        // Matriks normalisasi
        $matriksNormalisasi = [];

        // Matriks nilai maksimum dan minimum
        $matriksMax = [];
        $matriksMin = [];

        // Inisialisasi matriks nilai maksimum dan minimum (hanya dari nilai yang ada)
        foreach ($matriksNilai as $guruId => $kriteriaSet) {
            foreach ($kriteriaSet as $kriteriaId => $nilai) {
                // Skip nilai null atau kosong
                if ($nilai === null || $nilai === '' || $nilai === 0) {
                    continue;
                }

                if (!isset($matriksMax[$kriteriaId]) || $nilai > $matriksMax[$kriteriaId]) {
                    $matriksMax[$kriteriaId] = $nilai;
                }

                if (!isset($matriksMin[$kriteriaId]) || $nilai < $matriksMin[$kriteriaId]) {
                    $matriksMin[$kriteriaId] = $nilai;
                }
            }
        }

        // Hitung matriks normalisasi
        foreach ($matriksNilai as $guruId => $kriteriaSet) {
            foreach ($kriteriaSet as $kriteriaId => $nilai) {
                // Skip nilai null atau kosong - set normalisasi ke null
                if ($nilai === null || $nilai === '' || $nilai === 0) {
                    $matriksNormalisasi[$guruId][$kriteriaId] = null;
                    continue;
                }

                $kriteria = Kriteria::find($kriteriaId);

                // Hitung normalisasi berdasarkan jenis kriteria
                if ($kriteria->jenis_kriteria == 'Benefit') {
                    $max = $matriksMax[$kriteriaId] ?? 1;
                    $matriksNormalisasi[$guruId][$kriteriaId] = ($max == 0) ? 0 : $nilai / $max;
                } else {
                    $min = $matriksMin[$kriteriaId] ?? 1;
                    $matriksNormalisasi[$guruId][$kriteriaId] = ($nilai == 0) ? 0 : $min / $nilai;
                }
            }
        }

        return $matriksNormalisasi;
    }

    public function hitungNilaiTerbobot($matriksNormalisasi, $dataKriteria)
    {
        $nilaiTerbobot = [];

        // Iterasi melalui setiap guru
        foreach ($matriksNormalisasi as $guruId => $kriteriaSet) {
            $totalNilaiTerbobot = 0;
            $hasValue = false;

            // Iterasi melalui setiap kriteria
            foreach ($kriteriaSet as $kriteriaId => $normalisasi) {
                // Skip jika normalisasi null
                if ($normalisasi === null) {
                    continue;
                }

                $kriteria = $dataKriteria->find($kriteriaId);
                if (!$kriteria)
                    continue;

                $hasValue = true;

                // Hitung nilai terbobot untuk setiap kriteria
                $nilaiTerbobotKriteria = $normalisasi * $kriteria->bobot_kriteria;

                // Akumulasikan nilai terbobot untuk setiap kriteria
                $totalNilaiTerbobot += $nilaiTerbobotKriteria;
            }

            // Simpan total nilai terbobot untuk guru tertentu (hanya jika ada nilai)
            if ($hasValue) {
                $nilaiTerbobot[$guruId] = $totalNilaiTerbobot;
            }
        }

        return $nilaiTerbobot;
    }

    public function store(Request $request)
    {
        // Validasi formulir - nilai sekarang opsional (nullable)
        $request->validate([
            'periode' => ['required', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'nilai.*.*' => 'nullable|numeric|min:0|max:100',
        ]);

        // Filter matriks nilai - hapus nilai kosong/null
        $matriksNilai = [];
        if ($request->nilai) {
            foreach ($request->nilai as $guruId => $kriteriaSet) {
                foreach ($kriteriaSet as $kriteriaId => $nilai) {
                    // Konversi string kosong ke null, simpan nilai yang valid
                    $matriksNilai[$guruId][$kriteriaId] = ($nilai !== null && $nilai !== '') ? (int) $nilai : null;
                }
            }
        }

        // Cek apakah ada setidaknya satu nilai yang diisi
        $hasAnyValue = false;
        foreach ($matriksNilai as $guruId => $kriteriaSet) {
            foreach ($kriteriaSet as $kriteriaId => $nilai) {
                if ($nilai !== null && $nilai !== '') {
                    $hasAnyValue = true;
                    break 2;
                }
            }
        }

        if (!$hasAnyValue) {
            return back()->withErrors(['nilai' => 'Minimal harus ada satu pegawai yang memiliki nilai.']);
        }

        // ambil data guru
        $allGuru = Guru::all();

        // Ambil data kriteria
        $dataKriteria = Kriteria::all();

        // hitung matriks normalisasi
        $matriksNormalisasi = $this->hitungMatriksNormalisasi($matriksNilai);
        // hitung nilai terbobot
        $nilaiTerbobotResult = $this->hitungNilaiTerbobot($matriksNormalisasi, $dataKriteria);

        // Simpan nilai terbobot ke dalam tabel nilai_terbobot (atau tabel yang sesuai)
        foreach ($nilaiTerbobotResult as $guruId => $nilaiTerbobot) {
            NilaiTerbobot::updateOrCreate(
                ['guru_id' => $guruId, 'periode' => $request->periode],
                ['nilai_terbobot' => $nilaiTerbobot]
            );
        }

        // Simpan matriks normalisasi ke dalam tabel penilaian
        foreach ($matriksNormalisasi as $guruId => $kriteriaSet) {
            foreach ($kriteriaSet as $kriteriaId => $normalisasi) {
                $nilai = $matriksNilai[$guruId][$kriteriaId] ?? null;

                // Hanya simpan jika ada nilai
                if ($nilai !== null && $nilai !== '') {
                    Penilaian::updateOrCreate(
                        [
                            'guru_id' => $guruId,
                            'kriteria_id' => $kriteriaId,
                            'periode' => $request->periode,
                        ],
                        [
                            'nilai' => $nilai,
                            'normalisasi' => $normalisasi,
                        ]
                    );
                }
            }
        }

        return view('penilaian.hasil_perhitungan')->with([
            'dataNormalisasi' => $matriksNormalisasi,
            'dataTerbobot' => $nilaiTerbobotResult,
            'dataKriteria' => $dataKriteria,
            'allGuru' => $allGuru,
            'periode' => $request->periode
        ]);
    }
}

