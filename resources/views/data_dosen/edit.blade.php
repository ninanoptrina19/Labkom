<!-- resources/views/data_dosens/edit.blade.php -->

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
        <h1>Edit Data Dosen</h1>

        <form action="{{ route('data_dosens.update', $dosen->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" class="form-control" value="{{ $dosen->nama }}" required>
            </div>
            <div class="form-group">
                <label for="nidn">NIDN:</label>
                <input type="text" name="nidn" class="form-control" value="{{ $dosen->nidn }}" required>
            </div>
            <div class="form-group">
                <label for="prodi">Prodi:</label>
                <select name="prodi" class="form-control" required>
                    <option value="">Pilih Prodi</option>
                    <option value="DIII Kebidanan" {{ $dosen->prodi == 'DIII Kebidanan' ? 'selected' : '' }}>DIII Kebidanan</option>
                    <option value="S1 Kebidanan" {{ $dosen->prodi == 'S1 Kebidanan' ? 'selected' : '' }}>S1 Kebidanan</option>
                    <option value="S1 Gizi" {{ $dosen->prodi == 'S1 Gizi' ? 'selected' : '' }}>S1 Gizi</option>
                    <option value="S1 Farmasi" {{ $dosen->prodi == 'S1 Farmasi' ? 'selected' : '' }}>S1 Farmasi</option>
                    <option value="S1 Administrasi Rumah Sakit" {{ $dosen->prodi == 'S1 Administrasi Rumah Sakit' ? 'selected' : '' }}>S1 Administrasi Rumah Sakit</option>
                    <option value="S1 Keperawatan" {{ $dosen->prodi == 'S1 Keperawatan' ? 'selected' : '' }}>S1 Keperawatan</option>
                    <option value="NERS" {{ $dosen->prodi == 'NERS' ? 'selected' : '' }}>NERS</option>
                    <option value="S1 Pendidian Guru SD" {{ $dosen->prodi == 'S1 Pendidian Guru SD' ? 'selected' : '' }}>S1 Pendidian Guru SD</option>
                    <option value="S1 Pendidikan Matematika" {{ $dosen->prodi == 'S1 Pendidikan Matematika' ? 'selected' : '' }}>S1 Pendidikan Matematika</option>
                    <option value="S1 Pendidikan Guru MI" {{ $dosen->prodi == 'S1 Pendidikan Guru MI' ? 'selected' : '' }}>S1 Pendidikan Guru MI</option>
                    <option value="S1 Pendidikan Agama Islam" {{ $dosen->prodi == 'S1 Pendidikan Agama Islam' ? 'selected' : '' }}>S1 Pendidikan Agama Islam</option>
                    <option value="S1 Sistem Informasi" {{ $dosen->prodi == 'S1 Sistem Informasi' ? 'selected' : '' }}>S1 Sistem Informasi</option>
                    <option value="S1 Informatika" {{ $dosen->prodi == 'S1 Informatika' ? 'selected' : '' }}>S1 Informatika</option>
                    <option value="S1 Manajemen" {{ $dosen->prodi == 'S1 Manajemen' ? 'selected' : '' }}>S1 Manajemen</option>
                    <option value="S1 Akuntansi" {{ $dosen->prodi == 'S1 Akuntansi' ? 'selected' : '' }}>S1 Akuntansi</option>
                    <option value="S1 Ekonomi Syariah" {{ $dosen->prodi == 'S1 Ekonomi Syariah' ? 'selected' : '' }}>S1 Ekonomi Syariah</option>
                    <option value="S1 Perbankan Syariah" {{ $dosen->prodi == 'S1 Perbankan Syariah' ? 'selected' : '' }}>S1 Perbankan Syariah</option>
                    <option value="S2 Kesehatan Masyarakat" {{ $dosen->prodi == 'S2 Kesehatan Masyarakat' ? 'selected' : '' }}>S2 Kesehatan Masyarakat</option>
                    <option value="S2 Pendidikan Agama Islam" {{ $dosen->prodi == 'S2 Pendidikan Agama Islam' ? 'selected' : '' }}>S2 Pendidikan Agama Islam</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fakultas">Fakultas:</label>
                <select name="fakultas" class="form-control" required>
                    <option value="">Pilih Fakultas</option>
                    <option value="Fakultas Ekonomi Bisnis" {{ $dosen->fakultas == 'Fakultas Ekonomi Bisnis' ? 'selected' : '' }}>Fakultas Ekonomi Bisnis</option>
                    <option value="Fakultas Ilmu Kesehatan" {{ $dosen->fakultas == 'Fakultas Ilmu Kesehatan' ? 'selected' : '' }}>Fakultas Ilmu Kesehatan</option>
                    <option value="Fakultas Komputer dan Teknik" {{ $dosen->fakultas == 'Fakultas Komputer dan Teknik' ? 'selected' : '' }}>Fakultas Komputer dan Teknik</option>
                    <option value="Fakultas Ilmu Tarbiah dan Keguruan" {{ $dosen->fakultas == 'Fakultas Ilmu Tarbiah dan Keguruan' ? 'selected' : '' }}>Fakultas Ilmu Tarbiah dan Keguruan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="telepon">Telepon:</label>
                <input type="text" name="telepon" class="form-control" value="{{ $dosen->telepon }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" value="{{ $dosen->user->email }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password (Biarkan kosong jika tidak ingin mengubah):</label>
                <input type="password" name="password" class="form-control">
            </div>
            <br></br>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('/dosen') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
