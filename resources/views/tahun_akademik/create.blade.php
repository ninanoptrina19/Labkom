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
        <h1>Tambah Tahun Akademik</h1>

        <form action="{{ route('tahun_akademik.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <br></br>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('/tahun_akademik') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
