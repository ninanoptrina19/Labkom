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
                <label for="alamat">Alamat:</label>
                <input type="text" name="alamat" class="form-control" value="{{ $dosen->alamat }}" required>
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
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
