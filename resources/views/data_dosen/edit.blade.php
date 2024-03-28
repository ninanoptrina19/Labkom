<!-- resources/views/data_dosens/edit.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        <h1>Edit Data Dosen</h1>

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

        <form action="{{ route('data_dosens.update', $dataDosen->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="kode">Kode:</label>
                <input type="text" name="kode" class="form-control" value="{{ $dataDosen->kode }}" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" class="form-control" value="{{ $dataDosen->nama }}" required>
            </div>
            <div class="form-group">
                <label for="nidn">NIDN:</label>
                <input type="number" name="nidn" class="form-control" value="{{ $dataDosen->nidn }}" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" name="alamat" class="form-control" value="{{ $dataDosen->alamat }}" required>
            </div>
            <div class="form-group">
                <label for="telepon">Telepon:</label>
                <input type="number" name="telepon" class="form-control" value="{{ $dataDosen->telepon }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
