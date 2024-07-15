<?php

namespace App\Http\Controllers;

use App\Models\DataJadwal;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class LandingpageController extends Controller
{
    public function index(Request $request)
    {
        $tahunAkademik = $request->input('tahun_akademik');
        $jadwal = DataJadwal::when($tahunAkademik, function ($query, $tahunAkademik) {
            return $query->where('tahun_akademik_id', $tahunAkademik);
        })->get();
        $allTahunAkademik = TahunAkademik::all();
        return view('welcome', compact('jadwal', 'allTahunAkademik', 'tahunAkademik'));
    }
    
}
