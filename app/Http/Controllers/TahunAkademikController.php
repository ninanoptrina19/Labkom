<?php

namespace App\Http\Controllers;

use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class TahunAkademikController extends Controller
{
    public function index()
    {
        $tahun_akademik = TahunAkademik::all();
        return view('tahun_akademik.index', compact('tahun_akademik'));
    }

    public function create()
    {
        return view('tahun_akademik.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ], [
            'nama.required' => 'Nama tahun_akademik harus diisi',
        ]);

        TahunAkademik::create($validatedData);

        return redirect()->route('tahun_akademik.index')->with('success', 'Data tahun_akademik berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $tahun_akademik = TahunAkademik::find($id);
        return view('tahun_akademik.edit', compact('tahun_akademik'));
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'nama' => 'required',
        ], [
            'nama.required' => 'Nama tahun_akademik harus diisi',

        ]);

        // Temukan data berdasarkan ID
        $tahun_akademik = TahunAkademik::find($id);


        // Perbarui data dengan data yang validasi
        $tahun_akademik->update($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('tahun_akademik.index')->with('success', 'Data tahun_akademik berhasil diperbarui!');
    }

    public function destroy($id)
    {

        $tahun_akademik = TahunAkademik::find($id);
        $tahun_akademik->delete();

        return redirect()->route('tahun_akademik.index')->with('success', 'Data tahun_akademik berhasil dihapus!');
    }
}
