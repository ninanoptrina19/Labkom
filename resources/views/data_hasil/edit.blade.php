<!-- resources/views/data_dosens/edit.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        <h1>Edit hasil</h1>

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

        <form action="{{ route('data_hasil.update', $hasil->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="dosen">Dosen:</label>
                <select name="dosen_id" class="form-control" required>
                    @foreach($dosens as $dosen)
                        <option value="{{ $dosen->id }}" {{ $dosen->id == $hasil->dosen_id ? 'selected' : '' }}>{{ $dosen->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="prodi">Prodi:</label>
                <input type="text" name="prodi" class="form-control" value="{{ $hasil->prodi }}" required>
            </div>
            <div class="form-group">
                <label for="mata_kuliah">Mata Kuliah:</label>
                <input type="text" name="mata_kuliah" class="form-control" value="{{ $hasil->mata_kuliah }}" required>
            </div>
            <div class="form-group">
                <label for="laboratorium">Laboratorium:</label>
                <select name="laboratorium_id" class="form-control" required>
                    <option value="">Pilih Laboratorium</option>
                    @foreach($laboratoriums as $laboratorium)
                        <option value="{{ $laboratorium->id }}" {{ $laboratorium->id == $hasil->laboratorium_id ? 'selected' : '' }}>{{ $laboratorium->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="hari">Hari:</label>
                <select name="hari" class="form-control" required>
                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $hari)
                        <option value="{{ $hari }}" {{ $hasil->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jam">Jam:</label>
                <select name="jam" class="form-control" required>
                    @for ($i = 8; $i <= 16; $i++)
                        @php
                            $jamMulai = sprintf("%02d", $i);
                            $jamSelesai = sprintf("%02d", $i + 1);
                            $jamOption = $jamMulai . ':00-' . $jamSelesai . ':00';
                        @endphp
                        <option value="{{ $jamOption }}" {{ $hasil->jam == $jamOption ? 'selected' : '' }}>{{ $jamMulai }}:00 - {{ $jamSelesai }}:00</option>
                    @endfor
                </select>
            </div>
            
            <div class="form-group">
                <label for="semester">Semester:</label>
                <input type="text" name="semester" class="form-control" value="{{ $hasil->semester }}" required>
            </div>
            <div class="form-group">
                <label for="angkatan">Angkatan:</label>
                <input type="text" name="angkatan" class="form-control" value="{{ $hasil->angkatan }}" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $hasil->tanggal }}" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <input type="text" name="keterangan" class="form-control" value="{{ $hasil->keterangan }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
