<!-- resources/views/data_dosens/index.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        <h1>Daftar Data Dosen</h1>

        <a href="{{ route('data_dosens.create') }}" class="btn btn-primary mb-3">Tambah Data Dosen</a>

        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Kode</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIDN</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dosens as $dosen)
                    <tr>
                        <td>{{ $dosen->kode }}</td>
                        <td>{{ $dosen->nama }}</td>
                        <td>{{ $dosen->nidn }}</td>
                        <td>{{ $dosen->alamat }}</td>
                        <td>{{ $dosen->telepon }}</td>
                        <td>
                        <a href="{{ url('/data_dosens/edit/' . $dosen->id) }}" class="btn btn-warning btn-sm">Edit</a>



                            <form action="{{ route('data_dosens.destroy', $dosen->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" style="display: inline-block;">
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
