@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        <h1>Daftar Jadwal</h1>

        <a href="{{ route('data_jadwal.create') }}" class="btn btn-primary mb-3">Tambah jadwal</a>

        @if (Auth::user()->roles == 'admin')
        <a href="{{ route('hasil.pdf', ['tahun_akademik' => request('tahun_akademik'),'prodi' => request('prodi'), 'semester' => request('semester')]) }}" class="btn btn-primary float-end">Cetak PDF</a>
        @endif
        
        <form id="filterForm" action="{{ route('data_jadwal.index') }}" method="GET">
            <div class="row d-flex">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="tahun_akademik" class="form-label">Filter berdasarkan Tahun Akademik:</label>
                        <select class="form-select" name="tahun_akademik" id="tahun_akademik" onchange="this.form.submit()">
                            <option value="">Pilih Tahun Akademik</option>
                            @foreach ($tahun_akademik as $item)
                                <option value="{{ $item }}" @if(request('tahun_akademik') == $item) selected @endif>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="semester" class="form-label">Filter berdasarkan Semester:</label>
                        <select class="form-select" name="semester" id="semester" onchange="this.form.submit()">
                            <option value="">Pilih Semester</option>
                            <option value="genap" @if(request('semester') == 'genap') selected @endif>Genap</option>
                            <option value="ganjil" @if(request('semester') == 'ganjil') selected @endif>Ganjil</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="prodi" class="form-label">Filter berdasarkan Prodi:</label>
                        <select class="form-select" name="prodi" id="prodi" onchange="this.form.submit()">
                            <option value="">Pilih Prodi</option>
                            @foreach ($prodi as $item)
                                <option value="{{ $item }}" @if(request('prodi') == $item) selected @endif>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </form>
        
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (count($jadwal) > 0)
            <div class="table-responsive">

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
                            <th scope="col">Tahun Akademik</th>
                            <th scope="col">Angkatan</th>
                            <th scope="col">Keterangan</th>
                            @if (Auth::user()->roles == 'admin')
                            <th scope="col">Aksi</th>
                            @endif
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
                                <td>{{ $jadwal->tahun_akademik }}</td>
                                <td>{{ $jadwal->angkatan }}</td>
                                <td>{{ $jadwal->keterangan }}</td>
        @if (Auth::user()->roles == 'admin')
        <td>
            <a href="{{ route('data_jadwal.edit', $jadwal->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('data_jadwal.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
        <p>Tidak ada hasil penjadwalan yang ditemukan.</p>
         @endif
    </div>
@endsection
