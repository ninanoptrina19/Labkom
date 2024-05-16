<!-- resources/views/data_dosens/index.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        <h1>Daftar Jadwal</h1>

        <a href="{{ route('data_jadwal.create') }}" class="btn btn-primary mb-3">Tambah jadwal</a>

        <a href="{{ route('hasil.pdf') }}"  class="btn btn-primary float-end">Cetak PDF</a>

        {{-- <form id="filterForm" action="{{ route('data_jadwal.index') }}" method="GET">
            <div class="mb-3">
                <label for="angkatan" class="form-label">Filter berdasarkan angkatan:</label>
                <select class="form-select" name="angkatan" id="angkatan">
                    <option value="">Pilih Angkatan</option>
                    @foreach ($angkatan as $item)
                        <option value="{{ $item }}" @if(request('angkatan') == $item) selected @endif>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </form> --}}
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (count($jadwal) > 0)
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
                @foreach ($jadwal as $jadwal)
                    <tr>
                        <td>{{ $jadwal->dosen->nama}}</td>
                        <td>{{ $jadwal->prodi }}</td>
                        <td>{{ $jadwal->mata_kuliah }} </td>
                        <td>{{ $jadwal->laboratorium->nama}}</td>
                        <td>{{ $jadwal->hari }}</td>
                        <td>{{ $jadwal->jam}}</td>
                        <td>{{ $jadwal->semester }}</td>
                        <td>{{ $jadwal->angkatan }}</td>
                        <td>{{ date("d/m/Y", strtotime($jadwal->tanggal)) }}</td>
                        <td>{{ $jadwal->keterangan }}</td>
<td>
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
