<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataDosen;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = DataDosen::all();
        return view('data_dosen.index', compact('dosens'));
    }

    public function create()
    {
        return view('data_dosen.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required|unique:data_dosen',
            'nama' => 'required',
            'nidn' => 'required|integer',
            'alamat' => 'required',
            'telepon' => 'required|integer',
        ],[
            'integer' => 'harus nomer'
        ]);

        DataDosen::create($validatedData);

        return redirect()->route('data_dosens.index')->with('success', 'Data Dosen berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $dataDosen = DataDosen::find($id);

        
        return view('data_dosen.edit', compact('dataDosen'));
    }

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'kode' => 'required|',
            'nama' => 'required',
            'nidn' => 'required|integer',
            'alamat' => 'required',
            'telepon' => 'required|integer',
        ]);

        // Temukan data berdasarkan ID
        $dataDosen = DataDosen::find($id);
    

        // Perbarui data dengan data yang validasi
        $dataDosen->update($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('data_dosens.index')->with('success', 'Data Dosen berhasil diperbarui!');
    }

    public function destroy($id)
    {

        $dataDosen = DataDosen::find($id);
        $dataDosen->delete();

        return redirect()->route('data_dosens.index')->with('success', 'Data Dosen berhasil dihapus!');
    }
}
