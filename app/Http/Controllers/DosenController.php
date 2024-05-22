<?php

namespace App\Http\Controllers;
use App\Models\DataDosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        // dd($request);
        $validatedData = $request->validate([
            'nama' => 'required',
            'nidn' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

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
            'alamat' => $validatedData['alamat'],
            'telepon' => $validatedData['telepon'],
        ]);

        return redirect()->route('data_dosens.index')->with('success', 'Data Dosen berhasil ditambahkan!');
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
            'nidn' => 'required|integer',
            'alamat' => 'required',
            'telepon' => 'required|integer',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
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
            'alamat' => $validatedData['alamat'],
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
}
