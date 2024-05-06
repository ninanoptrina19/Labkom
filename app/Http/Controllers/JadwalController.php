<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\DataJadwal;
use App\Models\DataDosen;
use App\Models\DataLaboratorium;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = DataJadwal::all();
        return view('jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        $dosens= DataDosen::all();
        $laboratoriums= DataLaboratorium::all();
        return view('jadwal.create', compact( 'dosens','laboratoriums')); 
    }

    public function store(Request $request)
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

        ],[
            'integer' => 'harus diisi'
        ]);

        DataJadwal::create($validatedData);

        return redirect()->route('data_jadwal.index')->with('success', 'Data Jadwal berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $jadwal = DataJadwal::find($id);
        $dosens = DataDosen::all();
        $laboratoriums = DataLaboratorium::all();
        
        return view('jadwal.edit', compact('jadwal','dosens','laboratoriums'));
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
        $dataJadwal = DataJadwal::find($id);
        // Perbarui data dengan data yang validasi
        $dataJadwal->update($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('data_jadwal.index')->with('success', 'Data Jadwal berhasil diperbarui!');
    }

    public function destroy($id)
    {

        $dataJadwal = DataJadwal::find($id);
        $dataJadwal->delete();

        return redirect()->route('data_jadwal.index')->with('success', 'Data Jadwal berhasil dihapus!');
    }
}




