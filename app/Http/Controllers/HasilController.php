<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\DataJadwal;
use App\Models\DataDosen;
use App\Models\DataLaboratorium;
use App\Models\DataHasil;

class HasilController extends Controller
{
    public function index()
    {
        $hasil = DataHasil::all();
        return view('data_hasil.index', compact('hasil'));
    }

    // public function create()
    // {
    //     $dosens= DataDosen::all();
    //     $laboratoriums= DataLaboratorium::all();
    //     return view('jadwal.create', compact( 'dosens','laboratoriums')); 
    // }

    // public function store(Request $request)
    // {
       
    //     $validatedData = $request->validate([
    //         'dosen_id' => 'required',
    //         'prodi' => 'required',
    //         'mata_kuliah' => 'required',
    //         'laboratorium_id' => 'required',
    //         'hari' => 'required',
    //         'jam' => 'required',
    //         'semester'=>'required',
    //         'angkatan'=>'required',
    //         'tanggal' => 'required',
    //         'keterangan'=>'nullable',

    //     ],[
    //         'integer' => 'harus diisi'
    //     ]);

    //     DataHasil::create($validatedData);

    //     return redirect()->route('data_hasil.index')->with('success', 'Data Hasil berhasil ditambahkan!');
    // }

    public function edit($id)
    {
        $hasil = DataHasil::find($id);
        $dosens = DataDosen::all();
        // $jadwal = DataJadwal::all();
        $laboratoriums = DataLaboratorium::all();
        
        return view('hasil.edit', compact('hasil','dosens','laboratoriums','jadwal'));
    }

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'dosen_id' => 'required',
            'prodi' => 'required',
            'mata_kuliah' => 'required',
            'laboratorium_id' => 'required',
            'hari' => 'required',
            'jam' => 'required',
            'semester'=>'required',
            'angkatan'=>'required',
            'tanggal' => 'required',
            'keterangan'=>'nullable',
        ]);

        // Temukan data berdasarkan ID
        $dataHasil = DataHasil::find($id);
        // Perbarui data dengan data yang validasi
        $dataHasil->update($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('data_hasil.index')->with('success', 'Data Hasil Penjadwalan berhasil diperbarui!');
    }

    public function destroy($id)
    {

        $dataHasil = DataHasil::find($id);
        $dataHasil->delete();

        return redirect()->route('data_hasil.index')->with('success', 'Data hasil Penjadwalan berhasil dihapus!');
    }
}




