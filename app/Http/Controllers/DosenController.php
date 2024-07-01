<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\DataDosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function index()
    {

        $dosens = DataDosen::orderBy('created_at', 'asc')->get();
        return view('data_dosen.index', compact('dosens'));
    }
    public function profil()
    {
        $dosen = DataDosen::where('user_id', Auth::id())->with('user')->first();
        return view('data_dosen.profil', compact('dosen'));
    }

    public function create()
    {
        return view('data_dosen.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nama' => 'required',
            'nidn' => 'required',
            'prodi' => 'required',
            'fakultas' => 'required',
            'telepon' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ], [
            'nama.required' => 'Nama harus diisi',
            'nidn.required' => 'NIDN harus diisi',
            'prodi.required' => 'Prodi harus diisi',
            'fakultas.required' => 'Fakultas harus diisi',
            'telepon.required' => 'Telepon harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        DB::beginTransaction();
        try {
            // Buat user baru
            $user = User::create([
                'name' => $validatedData['nama'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'roles' => 'dosen',
            ]);

            // Buat data dosen baru
            DataDosen::create([
                'user_id' => $user->id,
                'nama' => $validatedData['nama'],
                'nidn' => $validatedData['nidn'],
                'prodi' => $validatedData['prodi'],
                'fakultas' => $validatedData['fakultas'],
                'telepon' => $validatedData['telepon'],
            ]);

            DB::commit();

            return redirect()->route('data_dosens.index')->with('success', 'Data Dosen berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data. Silakan coba lagi.']);
        }
    }

    public function edit($id)
    {
        $dosen = DataDosen::findOrFail($id);
        return view('data_dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $id)
    {

        $dosen = DataDosen::findOrFail($id);
        $user = User::findOrFail($dosen->user_id);
        $validatedData = $request->validate([
            'nama' => 'required',
            'nidn' => 'required',
            'prodi' => 'required',
            'fakultas' => 'required',
            'telepon' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nidn.required' => 'NIDN tidak boleh kosong',
            'prodi.required' => 'prodi tidak boleh kosong',
            'fakultas.required' => 'Telepon tidak boleh kosong',
            'telepon.required' => 'Telepon tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        // Temukan data dosen berdasarkan ID
        $dosen = DataDosen::findOrFail($id);
        $user = User::findOrFail($dosen->user_id);

        // Perbarui data user
        $user->update([
            'name' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'password' => $request->password ? Hash::make($validatedData['password']) : $user->password,
        ]);

        // Perbarui data dosen
        $dosen->update([
            'nama' => $validatedData['nama'],
            'nidn' => $validatedData['nidn'],
            'prodi' => $validatedData['prodi'],
            'fakultas' => $validatedData['fakultas'],
            'telepon' => $validatedData['telepon'],
        ]);

        return redirect()->route('data_dosens.index')->with('success', 'Data Dosen berhasil diperbarui!');
    }

    public function destroy($id)
    {

        $dataDosen = DataDosen::find($id);
        $dataDosen->delete();

        return redirect()->route('data_dosens.index')->with('success', 'Data Dosen berhasil dihapus!');
    }
    public function editProfil()
    {
        $dosen = DataDosen::where('user_id', Auth::id())->with('user')->first();
        return view('data_dosen.edit_profil', compact('dosen'));
    }

    public function profilUpdate(Request $request)
    {

        $dosen = DataDosen::where('user_id', Auth::id())->first();
        $user = User::findOrFail($dosen->user_id);

        $validatedData = $request->validate([
            'name' => 'required',
            'nidn' => 'required',
            'prodi' => 'required',
            'fakultas' => 'required',
            'telepon' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
        ]);



        // Perbarui data user
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $request->password ? Hash::make($validatedData['password']) : $user->password,
        ]);

        // Perbarui data dosen
        $dosen->update([
            'nidn' => $validatedData['nidn'],
            'prodi' => $validatedData['prodi'],
            'fakultas' => $validatedData['fakultas'],
            'telepon' => $validatedData['telepon'],
        ]);

        return redirect()->route('profil.index')->with('success', 'Profil berhasil diperbarui!');
    }
}
