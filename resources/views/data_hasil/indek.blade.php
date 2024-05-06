<!-- resources/views/data_dosens/index.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        <h1>Daftar Hasil Penghasilan</h1>

        <a class="btn btn-primary mb-3">Tambah hasil</a>

        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Dosen</th>
                    <th scope="col">Prodi</th>
                    <th scope="col">Mata Kuliah</th>
                    <th scope="col">Laboratorium</th>
                    <th scope="col">Hari</th>
                    <th scope="col">Jam</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Angkatan</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hasil as $hasil)
                    <tr>
                        <td>{{ $hasil->dosen->nama}}</td>
                        <td>{{ $hasil->prodi }}</td>
                        <td>{{ $hasil->mata_kuliah }} </td>
                        <td>{{ $hasil->laboratorium->nama}}</td>
                        <td>{{ $hasil->hari }}</td>
                        <td>{{ $hasil->jam}}</td>
                        <td>{{ $hasil->semester }}</td>
                        <td>{{ $hasil->angkatan }}</td>
                        <td>{{ date("d/m/Y", strtotime($hasil->tanggal)) }}</td>
                        <td>{{ $hasil->keterangan }}</td>
<td>
                        <a href="{{ route('data_hasil.edit', $hasil->id) }}" class="btn btn-warning btn-sm">Edit </a>



                            <form action="{{ route('data_hasil.destroy', $hasil->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" style="display: inline-block;">
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
