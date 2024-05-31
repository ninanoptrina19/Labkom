<!-- resources/views/data_dosens/edit.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        <h1>Edit Data Laboratorium</h1>

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

        <form action="{{ route('data_laboratorium.update', $dataLaboratorium->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" class="form-control" value="{{ $dataLaboratorium->nama }}" required>
            </div>
            <div class="form-group">
                <label for="kapasitas">Kapasitas:</label>
                <input type="string" name="kapasitas" class="form-control" value="{{ $dataLaboratorium->kapasitas }}" required>
            </div>
            <br></br>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('/laboratorium') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
