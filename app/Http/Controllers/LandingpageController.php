<?php

namespace App\Http\Controllers;

use App\Models\DataJadwal;
use Illuminate\Http\Request;

class LandingpageController extends Controller
{
    public function index()
    {
        $jadwal = DataJadwal::all();
        return view('welcome', compact('jadwal'));
    }
}
