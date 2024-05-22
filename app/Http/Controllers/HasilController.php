<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\DataJadwal;
use App\Models\DataDosen;
use App\Models\DataLaboratorium;
use App\Models\DataHasil;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;

class HasilController extends Controller
{
    public function index(Request $request)
    {
        $hasil = DataJadwal::all();
        $angkatan = DataJadwal::select('angkatan')->distinct()->pluck('angkatan');
    $hasil = DataJadwal::query();
    if ($request->filled('angkatan')) {
        $hasil->where('angkatan', $request->angkatan);
    }

    $hasil = $hasil->get();
        return view('data_hasil.index', compact('hasil','angkatan'));
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
    public function cetakPDF()
{
    $hasil = DataJadwal::with(['dosen', 'laboratorium'])->get();
    $pdf = Pdf::loadView('hasil_pdf', ['hasil' => $hasil])->setPaper('a4', 'landscape');
    
    return $pdf->download('hasil_penjadwalan.pdf');
}

    
}




