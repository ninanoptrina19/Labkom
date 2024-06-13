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
                @if (Auth::user()->roles == 'admin')
                <select name="dosen_id" class="form-control" required>
                    <option value="">Pilih Dosen</option>
                    @foreach($dosens as $dosen)
                        <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                    @endforeach
                </select>
                @else
                <input type="text" name="" class="form-control" value="{{ Auth::user()->name }}" id="" disabled>
                <input type="hidden" name="dosen_id" value="{{ Auth::user()->dosen->id }}" id="">
                @endif
            </div>
            
            <div class="form-group">
                <label for="prodi">Prodi:</label>
                <select name="prodi" class="form-control" required>
                    <option value="">Pilih Prodi</option>
                    <option value="DIII Kebidanan">DIII Kebidanan</option>
                    <option value="S1 Kebidanan">S1 Kebidanan</option>
                    <option value="S1 Gizi">S1 Gizi</option>
                    <option value="S1 Farmasi">S1 Farmasi</option>
                    <option value="S1 Administrasi Rumah Sakit">S1 Administrasi Rumah Sakit</option>
                    <option value="S1 Keperawatan">S1 Keperawatan</option>
                    <option value="NERS">NERS</option>
                    <option value="S1 Pendidian Guru SD">S1 Pendidian Guru SD</option>
                    <option value="S1 Pendidikan Matematika">S1 Pendidikan Matematika</option>
                    <option value="S1 Pendidikan Guru MI">S1 Pendidikan Guru MI</option>
                    <option value="S1 Pendidikan Agama Islam">S1 Pendidikan Agama Islam</option>
                    <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                    <option value="S1 Informatika">S1 Informatika</option>
                    <option value="S1 Manajemen">S1 Manajemen</option>
                    <option value="S1 Akuntansi">S1 Akuntansi</option>
                    <option value="S1 Ekonomi Syariah">S1 Ekonomi Syariah</option>
                    <option value="S1 Perbankan Syariah">S1 Perbankan Syariah</option>
                    <option value="S2 Kesehatan Masyarakat">S2 Kesehatan Masyarakat</option>
                    <option value="S2 Pendidikan Agama Islam">S2 Pendidikan Agama Islam</option>
                </select>
            </div>
            <div class="form-group">
                <label for="penggunaan"> Penggunaan:</label>
                <input type="text" name="penggunaan" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="laboratorium">Laboratorium:</label>
                <select name="laboratorium_id" class="form-control" required>
                    <option value="">Pilih Laboratorium</option>
                    @foreach($laboratoriums as $laboratorium)
                        <option value="{{ $laboratorium->id }}">{{ $laboratorium->nama }}</option>
                    @endforeach
                </select>
            </div>

            @php
                // Mengelompokkan jadwal yang sudah ada berdasarkan hari
                $jadwalTerisi = $existingSchedules->groupBy('hari')->map(function($day) {
                    return $day->pluck('jam')->toArray();
                })->toArray();
            @endphp

            <div class="form-group">
                <label for="hari">Hari:</label>
                <select name="hari" id="hari" class="form-control" required>
                    <option value="">Pilih Hari</option>
                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                        <option value="{{ $hari }}">{{ $hari }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="jam">Jam:</label>
                <select name="jam" id="jam" class="form-control" required>
                    <option value="">Pilih Jam</option>
                    @foreach(['07:00-08:40', '08:45-10:25', '10:30-12:00', '13:30-14:40', '14:45-16:25', '16:30-18:10'] as $jam)
                        <option value="{{ $jam }}">{{ $jam }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="semester">Semester:</label>
                <select name="semester" class="form-control" required>
                    <option value="">Pilih Semester</option>
                    <option value="Ganjil">Ganjil</option>
                    <option value="Genap">Genap</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tahun_akademik">Tahun Akademik:</label>
                <input type="text" name="tahun_akademik" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="angkatan">Angkatan:</label>
                <input type="text" name="angkatan" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <input type="text" name="keterangan" class="form-control">
            </div>
            <br></br>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('/jadwal') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <style>
        /* Gaya untuk opsi yang di-disable */
        select option:disabled {
            background-color: #8c8d8f; /* Warna abu-abu */
            color: #f3f3f3; /* Warna teks abu-abu */
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jadwalTerisi = @json($jadwalTerisi);

            document.getElementById('hari').addEventListener('change', function() {
                const selectedHari = this.value;
                const jamSelect = document.getElementById('jam');

                // Hapus semua opsi
                while (jamSelect.options.length > 1) {
                    jamSelect.remove(1);
                }

                // Tambahkan opsi jam, termasuk yang sudah terisi
                const jamOptions = ['07:00-08:40', '08:45-10:25', '10:30-12:00', '13:30-14:40', '14:45-16:25', '16:30-18:10'];
                jamOptions.forEach(jam => {
                    const option = document.createElement('option');
                    option.value = jam;
                    option.text = jam;

                    if (jadwalTerisi[selectedHari] && jadwalTerisi[selectedHari].includes(jam)) {
                        option.disabled = true;
                        option.text += ' (sudah terisi)';
                    }

                    jamSelect.add(option);
                });
            });
        });
    </script>
@endsection
