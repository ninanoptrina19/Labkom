<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLaboratorium;

class LaboratoriumController extends Controller
{
    public function index()
    {
        $laboratorium = DataLaboratorium::all();
        return view('data_laboratorium.index', compact('laboratorium'));
    }

    public function create()
    {
        return view('data_laboratorium.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'kapasitas' => 'required|integer',
        ], [
            'nama.required' => 'Nama Laboratorium harus diisi',
            'kapasitas.required' => 'Kapasitas harus diisi',
            'kapasitas.integer' => 'Kapasitas harus berupa angka',
        ]);

        DataLaboratorium::create($validatedData);

        return redirect()->route('data_laboratorium.index')->with('success', 'Data Laboratorium berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $dataLaboratorium = DataLaboratorium::find($id);


        return view('data_laboratorium.edit', compact('dataLaboratorium'));
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'nama' => 'required',
            'kapasitas' => 'required|integer',
        ], [
            'nama.required' => 'Nama Laboratorium harus diisi',
            'kapasitas.required' => 'Kapasitas harus diisi',
            'kapasitas.integer' => 'Kapasitas harus berupa angka',
        ]);

        // Temukan data berdasarkan ID
        $dataLaboratorium = DataLaboratorium::find($id);


        // Perbarui data dengan data yang validasi
        $dataLaboratorium->update($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('data_laboratorium.index')->with('success', 'Data Laboratorium berhasil diperbarui!');
    }

    public function destroy($id)
    {

        $dataLaboratorium = DataLaboratorium::find($id);
        $dataLaboratorium->delete();

        return redirect()->route('data_laboratorium.index')->with('success', 'Data Laboratorium berhasil dihapus!');
    }
}
