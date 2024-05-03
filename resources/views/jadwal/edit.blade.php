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
                <input type="text" name="dosen" class="form-control" value="{{ $jadwal->dosen }}" required>
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
                <input type="text" name="laboratorium" class="form-control" value="{{ $jadwal->laboratorium }}" required>
            </div>
            <div class="form-group">
                <label for="hari">Hari:</label>
                <input type="text" name="hari" class="form-control" value="{{ $jadwal->hari}}" required>
            </div>
            <div class="form-group">
                <label for="jam">Jam:</label>
                <input type="date" name="jam" class="form-control" value="{{ $jadwal->jam}}" required>
            </div>
            <div class="form-group">
                <label for="semester">Semester:</label>
                <input type="text" name="semester" class="form-control" value="{{ $jadwal->semester }}" required>
            </div>
            <div class="form-group">
                <label for="angkatan">Angkatan:</label>
                <input type="text" name="angkatan" class="form-control" value="{{ $jadwal->angkatan }}" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $jadwal->tanggal }}" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <input type="text" name="keterangan" class="form-control" value="{{ $jadwal->keterangan }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
