<!-- resources/views/data_dosens/index.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        <h1>Daftar Jadwal</h1>

        <a href="{{ route('data_jadwal.create') }}" class="btn btn-primary mb-3">Tambah jadwal</a>

        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Dosen</th>
                    <th scope="col">Prodi</th>
                    <th scope="col">Mata Kuliah</th>
                    <th scope="col">Laboratorium</th>
                    <th scope="col">Hari / Jam</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Angkatan</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwal as $jadwal)
                    <tr>
                        <td>{{ $jadwal->nama }}</td>
                        <td>{{ $jadwal->kapasitas }}</td>
                        <td>{{ $jadwal->prodi }}</td>
                        <td>{{ $jadwal->mata_kuliah }} ({{ $jadwal->sks }})</td>
                        <td>{{ $jadwal->laboratorium }}</td>
                        <td>{{ $jadwal->hari_jam }}</td>
                        <td>{{ $jadwal->semester }}</td>
                        <td>{{ $jadwal->angkatan }}</td>
                        <td>{{ date("d/m/Y", strtotime($jadwal->created_at)) }}</td>
                        <td>{{ $jadwal-keterangan }}</td>

                        <a href="{{ route('data_jadwal.edit', $jadwal->id) }}" class="btn btn-warning btn-sm">Edit</a>



                            <form action="{{ route('data_jadwal.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
