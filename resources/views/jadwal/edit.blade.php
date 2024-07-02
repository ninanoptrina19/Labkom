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

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h1>Edit Jadwal</h1>

        <form action="{{ route('data_jadwal.update', $data_jadwal->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="hari">Hari:</label>
                <select name="hari" id="hari" class="form-control" required>
                    <option value="">Pilih Hari</option>
                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                        <option value="{{ $hari }}" {{ $data_jadwal->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                    @endforeach
                </select>
            </div>
          
            
            <div class="form-group mb-3">
                <label for="laboratorium_id">Laboratorium:</label>
                <select name="laboratorium_id" class="form-control" required>
                    <option value="">Pilih Laboratorium</option>
                    @foreach($laboratoriums as $laboratorium)
                        <option value="{{ $laboratorium->id }}" {{ $data_jadwal->laboratorium_id == $laboratorium->id ? 'selected' : '' }}>{{ $laboratorium->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="tanggal_mulai">Tanggal Mulai:</label>
                <input type="date" name="tanggal_mulai" class="form-control" value="{{ $data_jadwal->tanggal_mulai }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="tanggal_selesai">Tanggal Selesai:</label>
                <input type="date" name="tanggal_selesai" class="form-control" value="{{ $data_jadwal->tanggal_selesai }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="jam">Jam:</label>
                <select name="jam" id="jam" class="form-control" required>
                    <option value="">Pilih Jam</option>
                    @foreach(['07:00-08:40', '08:45-10:25', '10:30-12:00', '13:30-14:40', '14:45-16:25', '16:30-18:10'] as $jam)
                        <option value="{{ $jam }}" {{ $data_jadwal->jam == $jam ? 'selected' : '' }}>{{ $jam }}</option>
                    @endforeach
                </select>
            </div>
            
            

            <div class="form-group mb-3">
                <label for="penggunaan">Penggunaan/Mata Kuliah:</label>
                <input type="text" name="penggunaan" class="form-control" value="{{ $data_jadwal->penggunaan }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="dosen_id">Dosen:</label>
                @if (Auth::user()->roles == 'admin')
                    <select name="dosen_id" class="form-control" required>
                        <option value="">Pilih Dosen</option>
                        @foreach($dosens as $dosen)
                            <option value="{{ $dosen->id }}" {{ $data_jadwal->dosen_id == $dosen->id ? 'selected' : '' }}>{{ $dosen->nama }}</option>
                        @endforeach
                    </select>
                @else
                    <input type="text" name="nama_dosen" class="form-control" value="{{ Auth::user()->name }}" disabled>
                    <input type="hidden" name="dosen_id" value="{{ Auth::user()->dosen->id }}">
                @endif
            </div>
            
            <div class="form-group mb-3">
                <label for="prodi">Prodi:</label>
                <select name="prodi" class="form-control" required>
                    <option value="">Pilih Prodi</option>
                    <option value="DIII Kebidanan" {{ $data_jadwal->prodi == 'DIII Kebidanan' ? 'selected' : '' }}>DIII Kebidanan</option>
                    <option value="S1 Kebidanan" {{ $data_jadwal->prodi == 'S1 Kebidanan' ? 'selected' : '' }}>S1 Kebidanan</option>
                    <option value="S1 Gizi" {{ $data_jadwal->prodi == 'S1 Gizi' ? 'selected' : '' }}>S1 Gizi</option>
                    <option value="S1 Farmasi" {{ $data_jadwal->prodi == 'S1 Farmasi' ? 'selected' : '' }}>S1 Farmasi</option>
                    <option value="S1 Administrasi Rumah Sakit" {{ $data_jadwal->prodi == 'S1 Administrasi Rumah Sakit' ? 'selected' : '' }}>S1 Administrasi Rumah Sakit</option>
                    <option value="S1 Keperawatan" {{ $data_jadwal->prodi == 'S1 Keperawatan' ? 'selected' : '' }}>S1 Keperawatan</option>
                    <option value="NERS" {{ $data_jadwal->prodi == 'NERS' ? 'selected' : '' }}>NERS</option>
                    <option value="S1 Pendidian Guru SD" {{ $data_jadwal->prodi == 'S1 Pendidian Guru SD' ? 'selected' : '' }}>S1 Pendidian Guru SD</option>
                    <option value="S1 Pendidikan Matematika" {{ $data_jadwal->prodi == 'S1 Pendidikan Matematika' ? 'selected' : '' }}>S1 Pendidikan Matematika</option>
                    <option value="S1 Pendidikan Guru MI" {{ $data_jadwal->prodi == 'S1 Pendidikan Guru MI' ? 'selected' : '' }}>S1 Pendidikan Guru MI</option>
                    <option value="S1 Pendidikan Agama Islam" {{ $data_jadwal->prodi == 'S1 Pendidikan Agama Islam' ? 'selected' : '' }}>S1 Pendidikan Agama Islam</option>
                    <option value="S1 Sistem Informasi" {{ $data_jadwal->prodi == 'S1 Sistem Informasi' ? 'selected' : '' }}>S1 Sistem Informasi</option>
                    <option value="S1 Informatika" {{ $data_jadwal->prodi == 'S1 Informatika' ? 'selected' : '' }}>S1 Informatika</option>
                    <option value="S1 Manajemen" {{ $data_jadwal->prodi == 'S1 Manajemen' ? 'selected' : '' }}>S1 Manajemen</option>
                    <option value="S1 Akuntansi" {{ $data_jadwal->prodi == 'S1 Akuntansi' ? 'selected' : '' }}>S1 Akuntansi</option>
                    <option value="S1 Ekonomi Syariah" {{ $data_jadwal->prodi == 'S1 Ekonomi Syariah' ? 'selected' : '' }}>S1 Ekonomi Syariah</option>
                    <option value="S1 Perbankan Syariah" {{ $data_jadwal->prodi == 'S1 Perbankan Syariah' ? 'selected' : '' }}>S1 Perbankan Syariah</option>
                    <option value="S2 Kesehatan Masyarakat" {{ $data_jadwal->prodi == 'S2 Kesehatan Masyarakat' ? 'selected' : '' }}>S2 Kesehatan Masyarakat</option>
                    <option value="S2 Pendidikan Agama Islam" {{ $data_jadwal->prodi == 'S2 Pendidikan Agama Islam' ? 'selected' : '' }}>S2 Pendidikan Agama Islam</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="tahun_akademik_id">Tahun Akademik:</label>
                <select name="tahun_akademik_id" class="form-control" required>
                    <option value="">Pilih Tahun Akademik</option>
                    @foreach($tahun_akademiks as $tahun_akademik)
                        <option value="{{ $tahun_akademik->id }}" {{ $data_jadwal->tahun_akademik_id == $tahun_akademik->id ? 'selected' : '' }}>{{ $tahun_akademik->nama }}</option>
                    @endforeach
                </select>
            </div>

           
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('/jadwal') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
