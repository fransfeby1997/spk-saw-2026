<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kriteria;
use App\Models\Periode;
use App\Models\NilaiTerbobot;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allPeriode = Periode::select('periode')->distinct()->pluck('periode');

    // Ambil periode dari request, jika tidak ada gunakan periode pertama sebagai default
    $selectedPeriode = $request->periode ?? $allPeriode->first();

    $data = Periode::with('guru')
    ->where('periode', $selectedPeriode)
    ->orderByDesc('nilai_terbobot') // Mengurutkan dari terbesar ke terkecil
    ->get();

    return view('periode.index', compact('data', 'allPeriode', 'selectedPeriode'));
    }

   



}
