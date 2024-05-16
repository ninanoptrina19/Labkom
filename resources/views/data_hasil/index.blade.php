<!-- resources/views/data_dosens/index.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        <h1>Daftar hasil</h1>
        <a href="{{ route('hasil.pdf') }}"  class="btn btn-primary">Cetak PDF</a>

        <form id="filterForm" action="{{ route('data_hasil.index') }}" method="GET">
            <div class="mb-3">
                <label for="angkatan" class="form-label">Filter berdasarkan angkatan:</label>
                <select class="form-select" name="angkatan" id="angkatan">
                    <option value="">Pilih Angkatan</option>
                    @foreach ($angkatan as $item)
                        <option value="{{ $item }}" @if(request('angkatan') == $item) selected @endif>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </form>

        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

       

        @if (count($hasil) > 0)
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada hasil penjadwalan yang ditemukan.</p>
    @endif
    </div>

    <script>
        // Tambahkan event listener untuk select angkatan
        document.getElementById('angkatan').addEventListener('change', function() {
            document.getElementById('filterForm').submit(); // Kirim formulir saat pilihan angkatan berubah
        });
    </script>
@endsection
