<?php

namespace App\Http\Controllers;

use TCPDF;
use App\Models\Guru;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use App\Models\NilaiTerbobot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class CetakController extends Controller
{
    public function cetakHasilPenilaian($guru_id, $periode)
    {
        $guru = Guru::findOrFail($guru_id);
        $dataKriteria = Kriteria::all();

        // Ambil nilai_terbobot berdasarkan guru_id DAN periode yang dipilih
        $nilaiTerbobot = (float) DB::table('nilai_terbobot')
            ->where('guru_id', $guru_id)
            ->where('periode', $periode)
            ->value('nilai_terbobot');

        // Ambil data nilai sebelum hitung berdasarkan guru_id dan periode
        $nilaiSebelumHitung = $this->ambilDataNilaiSebelumHitung($guru_id, $periode);

        $pdf = new TCPDF();
        $pdf->SetAutoPageBreak(true, 10);

        // Mulai pembuatan halaman PDF
        $pdf->AddPage();

        // Tambahkan konten ke halaman PDF
        $html = view('cetak.hasil_penilaian', compact('guru', 'nilaiTerbobot', 'dataKriteria', 'periode', 'nilaiSebelumHitung'))->render();
        $pdf->writeHTML($html, true, false, true, false, '');
        return $pdf->Output('hasil_penilaian' . $guru->nama_guru . '.pdf', 'D');
    }

    private function ambilDataNilaiSebelumHitung($guru_id, $periode)
    {
        // Ambil data penilaian sebelum dihitung berdasarkan guru_id dan periode
        $nilaiSebelumHitung = Penilaian::where('guru_id', $guru_id)
            ->where('periode', $periode)
            ->pluck('nilai', 'kriteria_id')
            ->toArray();

        return $nilaiSebelumHitung;
    }
}
