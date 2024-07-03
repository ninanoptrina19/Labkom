<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataJadwal;
use App\Models\DataDosen;
use App\Models\DataLaboratorium;
use App\Models\TahunAkademik;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class JadwalController extends Controller
{

    public function index(Request $request)
{
    $tahunAkademikFilter = $request->input('tahun_akademik_id');
    $prodiFilter = $request->input('prodi');

    // Query data jadwal
    $jadwalQuery = DataJadwal::query();

    // Filter berdasarkan peran pengguna
    if (auth()->user()->roles == 'admin') {
        if ($tahunAkademikFilter) {
            $jadwalQuery->where('tahun_akademik_id', $tahunAkademikFilter);
        }
        if ($prodiFilter) {
            $jadwalQuery->where('prodi', $prodiFilter);
        }
        $jadwal = $jadwalQuery->get();
    } else {
        // Jika pengguna bukan admin (dosen)
        $jadwalQuery->where('dosen_id', auth()->user()->dosen->id);
        if ($tahunAkademikFilter) {
            $jadwalQuery->where('tahun_akademik_id', $tahunAkademikFilter);
        }
        if ($prodiFilter) {
            $jadwalQuery->where('prodi', $prodiFilter);
        }
        $jadwal = $jadwalQuery->get();
    }

    // Ambil data tahun akademik untuk dropdown filter
    $tahun_akademik = TahunAkademik::all();

    $prodi = [
        'DIII Kebidanan', 'S1 Kebidanan', 'S1 Gizi', 'S1 Farmasi', 'S1 Administrasi Rumah Sakit',
        'S1 Keperawatan', 'NERS', 'S1 Pendidian Guru SD', 'S1 Pendidikan Matematika', 'S1 Pendidikan Guru MI',
        'S1 Pendidikan Agama Islam', 'S1 Sistem Informasi', 'S1 Informatika', 'S1 Manajemen', 'S1 Akuntansi',
        'S1 Ekonomi Syariah', 'S1 Perbankan Syariah', 'S2 Kesehatan Masyarakat', 'S2 Pendidikan Agama Islam'
    ];

    return view('jadwal.index', compact('jadwal', 'prodi', 'tahun_akademik'));
}


    public function create()
    {
        $dosens = DataDosen::all();
        $laboratoriums = DataLaboratorium::all();
        $tahun_akademiks = TahunAkademik::all();
        

        return view('jadwal.create', compact('dosens', 'laboratoriums', 'tahun_akademiks'));
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'hari' => 'required',
        'jam' => 'required',
        'laboratorium_id' => 'required',
        'penggunaan' => 'required',
        'dosen_id' => 'required',
        'prodi' => 'required',
        'tahun_akademik_id' => 'required',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
    ],[
        'required' => 'kolom :attribute harus diisi',

    ]);

    // Ambil input dari form
    $input = $request->all();

    $conflictingSchedule = DataJadwal::where(function ($query) use ($input) {
        $query->where('hari', $input['hari'])
              ->where('laboratorium_id', $input['laboratorium_id'])
              ->where(function ($query) use ($input) {
                  $query->whereBetween('tanggal_mulai', [$input['tanggal_mulai'], $input['tanggal_selesai']])
                        ->orWhereBetween('tanggal_selesai', [$input['tanggal_mulai'], $input['tanggal_selesai']])
                        ->orWhere(function ($query) use ($input) {
                            $query->where('tanggal_mulai', '<=', $input['tanggal_mulai'])
                                  ->where('tanggal_selesai', '>=', $input['tanggal_selesai']);
                        });
              });
    })->exists();

    if ($conflictingSchedule) {
        return redirect()->back()->withInput()->withErrors(['conflict' => 'Jadwal yang Anda masukkan bertabrakan dengan jadwal yang sudah ada. Silakan pilih hari, laboratorium, jam, atau tanggal yang berbeda.']);
    }

    DataJadwal::create($input);

    // Redirect dengan pesan sukses
    return redirect()->route('data_jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
}



    public function edit($id)
    {
        $data_jadwal = DataJadwal::find($id);
        $dosens = DataDosen::all();
        $laboratoriums = DataLaboratorium::all();
        $tahun_akademiks = TahunAkademik::all();

        return view('jadwal.edit', compact('data_jadwal', 'dosens', 'laboratoriums','tahun_akademiks'));
    }

    public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'hari' => 'required',
        'jam' => 'required',
        'laboratorium_id' => 'required',
        'penggunaan' => 'required',
        'dosen_id' => 'required',
        'prodi' => 'required',
        'tahun_akademik_id' => 'required',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
    ],[
        'required' => 'Kolom :attribute harus diisi.',
        'after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
    ]);

    // Ambil input dari form
    $input = $request->all();

    // Cek jadwal yang bertabrakan kecuali untuk jadwal dengan ID yang sedang diedit
    $conflictingSchedule = DataJadwal::where(function ($query) use ($input, $id) {
        $query->where('id', '<>', $id)
              ->where('hari', $input['hari'])
              ->where('laboratorium_id', $input['laboratorium_id'])
              ->where(function ($query) use ($input) {
                  $query->whereBetween('tanggal_mulai', [$input['tanggal_mulai'], $input['tanggal_selesai']])
                        ->orWhereBetween('tanggal_selesai', [$input['tanggal_mulai'], $input['tanggal_selesai']])
                        ->orWhere(function ($query) use ($input) {
                            $query->where('tanggal_mulai', '<=', $input['tanggal_mulai'])
                                  ->where('tanggal_selesai', '>=', $input['tanggal_selesai']);
                        });
              });
    })->exists();

    if ($conflictingSchedule) {
        return redirect()->back()->withInput()->withErrors(['conflict' => 'Jadwal yang Anda masukkan bertabrakan dengan jadwal yang sudah ada. Silakan pilih hari, laboratorium, jam, atau tanggal yang berbeda.']);
    }

    // Update data jadwal
    $data_jadwal = DataJadwal::findOrFail($id);
    $data_jadwal->update($input);

    // Redirect dengan pesan sukses
    return redirect()->route('data_jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
}


    public function destroy($id)
    {

        $dataJadwal = DataJadwal::find($id);
        $dataJadwal->delete();

        return redirect()->route('data_jadwal.index')->with('success', 'Data Jadwal berhasil dihapus!');
    }
    public function cetakPDF(Request $request)
    {
        $query = DataJadwal::with(['dosen', 'laboratorium','tahunAkademik']);


        if ($request->filled('tahun_akademik_id')) {
            $query->where('tahun_akademik_id', $request->tahun_akademiks);
        }
        if ($request->filled('prodi')) {
            $query->where('prodi', $request->prodi);
        }

        $jadwal = $query->get();
        $pdf = Pdf::loadView('hasil_pdf', ['hasil' => $jadwal])->setPaper('a4', 'landscape');

        return $pdf->download('hasil_penjadwalan.pdf');
    }

    public function checkJam(Request $request)
{
    $selectedHari = $request->input('hari');
    $selectedLaboratorium = $request->input('laboratorium_id');

    // Query ke database untuk mendapatkan jam yang sudah terisi
    $jadwalTerisi = DataJadwal::where('hari', $selectedHari)
                               ->where('laboratorium_id', $selectedLaboratorium)
                               ->pluck('jam');

    return response()->json($jadwalTerisi);
}
}
