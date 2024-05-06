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
        <h1>Tambah Jadwal</h1>

        <form action="{{ route('data_jadwal.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="dosen">Dosen:</label>
                <select name="dosen_id" class="form-control" required>
                    <option value="">Pilih Dosen</option>
                    @foreach($dosens as $dosen)
                        <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="prodi">Prodi:</label>
                <input type="text" name="prodi" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="mata_kuliah">Mata Kuliah:</label>
                <input type="text" name="mata_kuliah" class="form-control" required>
            </div>
            <!-- Di dalam view -->

<div class="form-group">
    <label for="laboratorium">Laboratorium:</label>
    <select name="laboratorium_id" class="form-control" required>
        <option value="">Pilih Laboratorium</option>
        @foreach($laboratoriums as $laboratorium)
            <option value="{{ $laboratorium->id }}">{{ $laboratorium->nama }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="hari">Hari:</label>
    <select name="hari" class="form-control" required>
        <option value="">Pilih Hari</option>
        <option value="Senin">Senin</option>
        <option value="Selasa">Selasa</option>
        <option value="Rabu">Rabu</option>
        <option value="Kamis">Kamis</option>
        <option value="Jumat">Jumat</option>
    </select>
</div>

<div class="form-group">
    <label for="jam">Jam:</label>
    <select name="jam" class="form-control" required>
        <option value="">Pilih Jam</option>
        @for ($i = 8; $i <= 16; $i++)
            @php
                $jamMulai = sprintf("%02d", $i);
                $jamSelesai = sprintf("%02d", $i + 1);
            @endphp
            <option value="{{ $jamMulai }}:00-{{ $jamSelesai }}:00">{{ $jamMulai }}:00 - {{ $jamSelesai }}:00</option>
        @endfor
    </select>
</div>

            <div class="form-group">
                <label for="semester">Semester:</label>
                <input type="text" name="semester" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="angkatan">Angkatan:</label>
                <input type="text" name="angkatan" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="datetime-local" name="tanggal" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <input type="text" name="keterangan" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
