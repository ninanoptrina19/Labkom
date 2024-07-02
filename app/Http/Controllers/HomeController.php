<?php

namespace App\Http\Controllers;
use App\Models\DataDosen;
use App\Models\DataLaboratorium;
use App\Models\DataJadwal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jadwalCount = DataJadwal::count();
        $jadwal = DataJadwal::all();
        $jadwalDosen = DataJadwal::where('dosen_id', auth()->user()->dosen->id)->get();
        $laboratorium = DataLaboratorium::count();
        $dosenCount = DataDosen::count();
        return view('home', compact ('dosenCount', 'laboratorium','jadwal','jadwalCount','jadwalDosen'));
    }
}
