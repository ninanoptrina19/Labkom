<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        // $users = User::where('roles', 'admin')->get();
        return view('user.index', compact('users'));
    }
    public function create()
    {
        return view('user.create');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|regex:/^[\pL\s]+$/u',
            'email' => 'required',
            'roles' => 'required',
        ], [
            'name.required' => 'Please enter your name',
            'email.required' => 'Please enter your email',
            'roles.required' => 'Please select your role',
            'name.regex' => 'Nama harus berupa huruf.',
        ]);

        // Buat password default berdasarkan nama dosen
        $password = Str::slug($validatedData['name']); // Gunakan nama dosen sebagai dasar password
        $validatedData['password'] = Hash::make($password);

        // Buat entri baru di tabel DataUser
        User::create($validatedData);

        return redirect()->route('data_user.index')->with('success', 'Data User berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'roles' => 'required',
            'password' => 'required|min:8', // tambahkan validasi password
        ], [
            'name.required' => 'Please enter your name',
            'email.required' => 'Please enter your email',
            'email.email' => 'Please enter a valid email',
            'roles.required' => 'Please select your role',
            'password.required' => 'Please enter your password',
            'password.min' => 'Password must be at least 8 characters',
        ]);

        $user = User::findOrFail($id);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->roles = $validatedData['roles'];
        $user->password = bcrypt($validatedData['password']); // simpan password yang di-hash

        // Simpan perubahan
        $user->save();

        return redirect()->route('data_user.index')->with('success', 'Data User berhasil diperbarui!');
    }

    public function destroy($id)
    {

        $user = User::find($id);
        $user->delete();

        return redirect()->route('data_user.index')->with('success', 'Data Dosen berhasil dihapus!');
    }
}
