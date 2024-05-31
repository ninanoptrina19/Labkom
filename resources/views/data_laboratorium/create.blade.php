<!-- resources/views/data_dosens/create.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        <h1>Tambah Data Laboratorium</h1>

        <form action="{{ route('data_laboratorium.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="kapasitas">Kapasitas:</label>
                <input type="string" name="kapasitas" class="form-control" required>
            </div>
            <br></br>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('/laboratorium') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
