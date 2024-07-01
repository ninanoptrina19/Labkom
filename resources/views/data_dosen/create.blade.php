<!-- resources/views/data_dosens/create.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
        @endif
        <h1>Tambah Data Dosen</h1>
            
        <form action="{{ route('data_dosens.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nidn">NIDN:</label>
                <input type="text" name="nidn" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="prodi">Prodi:</label>
                <select name="prodi" class="form-control" required>
                    <option value="">Pilih Prodi</option>
                    <option value="DIII Kebidanan">DIII Kebidanan</option>
                    <option value="S1 Kebidanan">S1 Kebidanan</option>
                    <option value="S1 Gizi">S1 Gizi</option>
                    <option value="S1 Farmasi">S1 Farmasi</option>
                    <option value="S1 Administrasi Rumah Sakit">S1 Administrasi Rumah Sakit</option>
                    <option value="S1 Keperawatan">S1 Keperawatan</option>
                    <option value="NERS">NERS</option>
                    <option value="S1 Pendidian Guru SD">S1 Pendidian Guru SD</option>
                    <option value="S1 Pendidikan Matematika">S1 Pendidikan Matematika</option>
                    <option value="S1 Pendidikan Guru MI">S1 Pendidikan Guru MI</option>
                    <option value="S1 Pendidikan Agama Islam">S1 Pendidikan Agama Islam</option>
                    <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                    <option value="S1 Informatika">S1 Informatika</option>
                    <option value="S1 Manajemen">S1 Manajemen</option>
                    <option value="S1 Akuntansi">S1 Akuntansi</option>
                    <option value="S1 Ekonomi Syariah">S1 Ekonomi Syariah</option>
                    <option value="S1 Perbankan Syariah">S1 Perbankan Syariah</option>
                    <option value="S2 Kesehatan Masyarakat">S2 Kesehatan Masyarakat</option>
                    <option value="S2 Pendidikan Agama Islam">S2 Pendidikan Agama Islam</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fakultas">Fakultas:</label>
                <select name="fakultas" class="form-control" required>
                    <option value="">Pilih Fakultas</option>
                    <option value="Fakultas Ekonomi Bisnis">Fakultas Ekonomi Bisnis</option>
                    <option value="Fakultas Ilmu Kesehatan">Fakultas Ilmu Kesehatan</option>
                    <option value="Fakultas Komputer dan Teknik">Fakultas Komputer dan Teknik</option>
                    <option value="Fakultas Ilmu Tarbiah dan Keguruan">Fakultas Ilmu Tarbiah dan Keguruan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="telepon">Telepon:</label>
                <input type="text" name="telepon" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <br></br>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('/dosen') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
