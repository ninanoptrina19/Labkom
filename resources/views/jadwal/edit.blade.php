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
                <input type="text" name="prodi" class="form-control" value="{{ $jadwal->prodi }}" required>
            </div>
            <div class="form-group">
                <label for="mata_kuliah">Mata Kuliah:</label>
                <input type="text" name="mata_kuliah" class="form-control" value="{{ $jadwal->mata_kuliah }}" required>
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
                <label for="tahun_akademik">Tahun Akademik:</label>
                <input type="text" name="tahun_akademik" class="form-control" value="{{$jadwal->tahun_akademik}}" required>
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
                <label for="angkatan">Angkatan:</label>
                <input type="text" name="angkatan" class="form-control" value="{{ $jadwal->angkatan }}" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <input type="text" name="keterangan" class="form-control" value="{{ $jadwal->keterangan }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
