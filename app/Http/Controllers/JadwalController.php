<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataJadwal;
use App\Models\DataDosen;
use App\Models\DataLaboratorium;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class JadwalController extends Controller
{

    public function index(Request $request)
    {
        $tahunAkademikFilter = $request->input('tahun_akademik');
        $semesterFilter = $request->input('semester');
        $prodiFilter = $request->input('prodi');


        if (auth()->user()->roles == 'admin') {
            $jadwalQuery = DataJadwal::query();
            if ($tahunAkademikFilter) {
                $jadwalQuery->where('tahun_akademik', $tahunAkademikFilter);
            }
            if ($prodiFilter) {
                $jadwalQuery->where('prodi', $prodiFilter);
            }
            if ($semesterFilter) {
                $jadwalQuery->where('semester', $semesterFilter);
            }
            $jadwal = $jadwalQuery->get();
        } else {
            $jadwalQuery = DataJadwal::where('dosen_id', auth()->user()->dosen->id);
            if ($tahunAkademikFilter) {
                $jadwalQuery->where('tahun_akademik', $tahunAkademikFilter);
            }
            if ($prodiFilter) {
                $jadwalQuery->where('prodi', $prodiFilter);
            }
            if ($semesterFilter) {
                $jadwalQuery->where('semester', $semesterFilter);
            }
            $jadwal = $jadwalQuery->get();
        }

        $tahun_akademik = DataJadwal::select('tahun_akademik')->distinct()->pluck('tahun_akademik');
        $prodi = DataJadwal::select('prodi')->distinct()->pluck('prodi');

        return view('jadwal.index', compact('jadwal', 'tahun_akademik', 'prodi'));
    }

    // public function index()
    // {
    //     $jadwal = DataJadwal::all();
    //     return view('jadwal.index', compact('jadwal'));
    // }

    public function create()
    {
        $dosens = DataDosen::all();
        $laboratoriums = DataLaboratorium::all();
        $existingSchedules = DataJadwal::all();

        return view('jadwal.create', compact('dosens', 'laboratoriums', 'existingSchedules'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'dosen_id' => 'required',
            'prodi' => 'required',
            'penggunaan' => 'required',
            'laboratorium_id' => 'required',
            'hari' => 'required',
            'jam' => 'required',
            'semester' => 'required',
            'angkatan' => 'required',
            'keterangan' => 'nullable',
            'tahun_akademik' => 'required',
        ], [
            'required' => 'harus diisi'
        ]);

        try {
            $existingSchedule = DataJadwal::where('laboratorium_id', $request->laboratorium_id)
                ->where('hari', $request->hari)
                ->where('jam', $request->jam)
                ->where('semester', $request->semester)
                ->where('tahun_akademik', $request->tahun_akademik)
                ->exists();

            if ($existingSchedule) {
                return redirect()->back()->withErrors(['Jadwal bentrok dengan jadwal lain.'])->withInput();
            }

            // Simpan data
            DataJadwal::create($validatedData);

            return redirect()->route('data_jadwal.index')->with('success', 'Data Jadwal berhasil ditambahkan!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])->withInput();
        }
    }


    public function edit($id)
    {
        $jadwal = DataJadwal::find($id);
        $dosens = DataDosen::all();
        $laboratoriums = DataLaboratorium::all();

        return view('jadwal.edit', compact('jadwal', 'dosens', 'laboratoriums'));
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'dosen_id' => 'required',
            'prodi' => 'required',
            'penggunaan' => 'required',
            'laboratorium_id' => 'required',
            'hari' => 'required',
            'jam' => 'required',
            'semester' => 'required',
            'angkatan' => 'required',
            'keterangan' => 'nullable',
            'tahun_akademik' => 'required',
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
    public function cetakPDF(Request $request)
    {
        $query = DataJadwal::with(['dosen', 'laboratorium']);

        if ($request->filled('tahun_akademik')) {
            $query->where('tahun_akademik', $request->tahun_akademik);
        }

        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }
        if ($request->filled('prodi')) {
            $query->where('prodi', $request->prodi);
        }

        $jadwal = $query->get();
        $pdf = Pdf::loadView('hasil_pdf', ['hasil' => $jadwal])->setPaper('a4', 'landscape');

        return $pdf->download('hasil_penjadwalan.pdf');
    }
}
