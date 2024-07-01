<!-- resources/views/data_dosens/edit.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        <h1>Edit Jadwal</h1>

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

        <form action="{{ route('data_jadwal.update', $jadwal->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="hari">Hari:</label>
                <select name="hari" class="form-control" required>
                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat','Sabtu'] as $hari)
                        <option value="{{ $hari }}" {{ $jadwal->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jam">Jam:</label>
                <select name="jam" class="form-control" required>
                    <option value="">Pilih Jam</option>
                    <option value="07:00-08:40">07:00 - 08:40</option>
                    <option value="08:45-10:25">08:45 - 10:25</option>
                    <option value="10:30-12:00">10:30 - 12:00</option>
                    <option value="13:30-14:40">13:30 - 14:40</option>
                    <option value="14:45-16:25">14:45 - 16:25</option>
                    <option value="16:30-18:10">16:30 - 18:10</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="laboratorium">Laboratorium:</label>
                <select name="laboratorium_id" class="form-control" required>
                    <option value="">Pilih Laboratorium</option>
                    @foreach($laboratoriums as $laboratorium) 
                        <option value="{{ $laboratorium->id }}" {{ $laboratorium->id == $jadwal->laboratorium_id ? 'selected' : '' }}>{{ $laboratorium->nama }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="penggunaan/mata_kuliah">Penggunaan/Mata_Kuliah:</label>
                <input type="text" name="penggunaan/mata_kuliah" class="form-control" value="{{ $jadwal->penggunaan/mata_kuliah }}" required>
            </div>

            <div class="form-group">
                <label for="dosen">Dosen:</label>
                <select name="dosen_id" class="form-control" required>
                    @foreach($dosens as $dosen)
                        <option value="{{ $dosen->id }}" {{ $dosen->id == $jadwal->dosen_id ? 'selected' : '' }}>{{ $dosen->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="prodi">Prodi:</label>
                <select name="prodi" class="form-control" required>
                    <option value="">Pilih Prodi</option>
                    <option value="DIII Kebidanan" <?= $jadwal->prodi == 'DIII Kebidanan' ? 'selected' : '' ?>>DIII Kebidanan</option>
                    <option value="S1 Kebidanan" <?= $jadwal->prodi == 'S1 Kebidanan' ? 'selected' : '' ?>>S1 Kebidanan</option>
                    <option value="S1 Gizi" <?= $jadwal->prodi == 'S1 Gizi' ? 'selected' : '' ?>>S1 Gizi</option>
                    <option value="S1 Farmasi" <?= $jadwal->prodi == 'S1 Farmasi' ? 'selected' : '' ?>>S1 Farmasi</option>
                    <option value="S1 Administrasi Rumah Sakit" <?= $jadwal->prodi == 'S1 Administrasi Rumah Sakit' ? 'selected' : '' ?>>S1 Administrasi Rumah Sakit</option>
                    <option value="S1 Keperawatan" <?= $jadwal->prodi == 'S1 Keperawatan' ? 'selected' : '' ?>>S1 Keperawatan</option>
                    <option value="NERS" <?= $jadwal->prodi == 'NERS' ? 'selected' : '' ?>>NERS</option>
                    <option value="S1 Pendidian Guru SD" <?= $jadwal->prodi == 'S1 Pendidian Guru SD' ? 'selected' : '' ?>>S1 Pendidian Guru SD</option>
                    <option value="S1 Pendidikan Matematika" <?= $jadwal->prodi == 'S1 Pendidikan Matematika' ? 'selected' : '' ?>>S1 Pendidikan Matematika</option>
                    <option value="S1 Pendidikan Guru MI" <?= $jadwal->prodi == 'S1 Pendidikan Guru MI' ? 'selected' : '' ?>>S1 Pendidikan Guru MI</option>
                    <option value="S1 Pendidikan Agama Islam" <?= $jadwal->prodi == 'S1 Pendidikan Agama Islam' ? 'selected' : '' ?>>S1 Pendidikan Agama Islam</option>
                    <option value="S1 Sistem Informasi" <?= $jadwal->prodi == 'S1 Sistem Informasi' ? 'selected' : '' ?>>S1 Sistem Informasi</option>
                    <option value="S1 Informatika" <?= $jadwal->prodi == 'S1 Informatika' ? 'selected' : '' ?>>S1 Informatika</option>
                    <option value="S1 Manajemen" <?= $jadwal->prodi == 'S1 Manajemen' ? 'selected' : '' ?>>S1 Manajemen</option>
                    <option value="S1 Akuntansi" <?= $jadwal->prodi == 'S1 Akuntansi' ? 'selected' : '' ?>>S1 Akuntansi</option>
                    <option value="S1 Ekonomi Syariah" <?= $jadwal->prodi == 'S1 Ekonomi Syariah' ? 'selected' : '' ?>>S1 Ekonomi Syariah</option>
                    <option value="S1 Perbankan Syariah" <?= $jadwal->prodi == 'S1 Perbankan Syariah' ? 'selected' : '' ?>>S1 Perbankan Syariah</option>
                    <option value="S2 Kesehatan Masyarakat" <?= $jadwal->prodi == 'S2 Kesehatan Masyarakat' ? 'selected' : '' ?>>S2 Kesehatan Masyarakat</option>
                    <option value="S2 Pendidikan Agama Islam" <?= $jadwal->prodi == 'S2 Pendidikan Agama Islam' ? 'selected' : '' ?>>S2 Pendidikan Agama Islam</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tahun_akademik">Tahun Akademik:</label>
                <select name="tahun_akademik_id" class="form-control" required>
                    <option value="">Pilih Tahun Akademik</option>
                    @foreach($tahun_akademiks as $tahun_akademik)
                        <option value="{{ $tahun_akademik->id }}" {{ $tahun_akademik->id == $jadwal->tahun_akademik_id ? 'selected' : '' }}>{{ $tahun_akademik->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal_mulai">Tanggal Mulai:</label>
                <input type="date" name="tanggal_mulai" class="form-control" value="{{ $jadwal->tanggal_mulai }}" required>
            </div>
            <div class="form-group">
                <label for="tanggal_berakhir">Tanggal Berakhir:</label>
                <input type="date" name="tanggal_berakhir" class="form-control" value="{{ $jadwal->tanggal_berakhir }}" required>
            </div>

            <br></br>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('/jadwal') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
