<!-- resources/views/data_dosens/index.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        <h1>Daftar Data Laboratorium</h1>

        <a href="{{ route('data_laboratorium.create') }}" class="btn btn-primary mb-3">Tambah Data Laboratorium</a>

        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Kapasitas</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laboratorium as $laboratorium)
                    <tr>
                        <td>{{ $laboratorium->nama }}</td>
                        <td>{{ $laboratorium->kapasitas }}</td>
                        <td>
                        <a href="{{ route('data_laboratorium.edit', $laboratorium->id) }}" class="btn btn-warning btn-sm">Edit</a>



                            <form action="{{ route('data_laboratorium.destroy', $laboratorium->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" style="display: inline-block;">
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
