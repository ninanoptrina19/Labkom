<!-- resources/views/data_dosens/edit.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        <h1>Edit Jadwal</h1>

        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('data_jadwal.update', $jadwal->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="dosen">Dosen:</label>
                <select name="dosen_id" class="form-control" required>
                    @foreach($dosens as $dosen)
                        <option value="{{ $dosen->id }}" {{ $dosen->id == $jadwal->dosen_id ? 'selected' : '' }}>{{ $dosen->nama }}</option>
                    @endforeach
                </select>
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
                <label for="penggunaan">Penggunaan:</label>
                <input type="text" name="penggunaan" class="form-control" value="{{ $jadwal->penggunaan }}" required>
            </div>
            <div class="form-group">
                <label for="laboratorium">Laboratorium:</label>
                <select name="laboratorium_id" class="form-control" required>
                    <option value="">Pilih Laboratorium</option>
                    @foreach($laboratoriums as $laboratorium)
                        <option value="{{ $laboratorium->id }}" {{ $laboratorium->id == $jadwal->laboratorium_id ? 'selected' : '' }}>{{ $laboratorium->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="hari">Hari:</label>
                <select name="hari" class="form-control" required>
                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat','Sabtu'] as $hari)
                        <option value="{{ $hari }}" {{ $jadwal->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jam">Jam:</label>
                <select name="jam" class="form-control" required>
                    <option value="">Pilih Jam</option>
                    <option value="07:00-08:40">07:00 - 08:40</option>
                    <option value="08:45-10:25">08:45 - 10:25</option>
                    <option value="10:30-12:00">10:30 - 12:00</option>
                    <option value="13:30-14:40">13:30 - 14:40</option>
                    <option value="14:45-16:25">14:45 - 16:25</option>
                    <option value="16:30-18:10">16:30 - 18:10</option>
                </select>
            </div>
            <div class="form-group">
                <label for="semester">Semester:</label>
                <select name="semester" class="form-control" required>
                    <option value="">Pilih Semester</option>
                    <option value="Ganjil">Ganjil</option>
                    <option value="Genap">Genap</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tahun_akademik">Tahun Akademik:</label>
                <input type="text" name="tahun_akademik" class="form-control" value="{{$jadwal->tahun_akademik}}" required>
            </div>
            <div class="form-group">
                <label for="angkatan">Angkatan:</label>
                <input type="text" name="angkatan" class="form-control" value="{{ $jadwal->angkatan }}" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <input type="text" name="keterangan" class="form-control" value="{{ $jadwal->keterangan }}" required>
            </div>
            <br></br>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('/jadwal') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
