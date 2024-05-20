@extends('layouts.dashboard')

@section('content')
    <div class="row my-4 px-3" style="gap: 10px">
        @if (auth()->user()->roles == 'admin')
            <div class="col-md-3 card mx-3 mb-3">
                <div class="d-flex align-items-end row">
                    <div class="col-8">
                        <div class="card-body">
                            <h6 class="card-title mb-1 text-nowrap">Data Dosen</h6>
                            <small class="d-block mb-3 text-nowrap">Yang terdaftar</small>
                            <h5 class="card-title text-primary mb-1">{{ $dosenCount }}</h5>
                            <small class="d-block mb-4 pb-1 text-muted">Dosen</small>
                            <a href="{{ url('/dosen') }}" class="btn btn-sm btn-primary">Data Dosen</a>
                        </div>
                    </div>
                    <div class="col-4 pt-3 ps-0">
                        <img src="{{ asset('/assets/img/illustrations/girl-doing-yoga-light.png') }}" width="100"
                            class="rounded-start" alt="View Sales">
                    </div>
                </div>
            </div>
            <div class="card col-md-3 mx-3 mb-3" style="gap: 10px">
                <div class="d-flex align-items-end row">
                    <div class="col-8">
                        <div class="card-body">
                            <h6 class="card-title mb-1 text-nowrap">Data Laboratorium</h6>
                            <small class="d-block mb-3 text-nowrap"> yang tersedia</small>
                            <h5 class="card-title text-primary mb-1">{{ $laboratorium }}</h5>
                            <small class="d-block mb-4 pb-1 text-muted">Laboratorium</small>
                            <a href="{{ url('/laboratorium') }}" class="btn btn-sm btn-primary">Data Laboratorium</a>
                        </div>
                    </div>
                    <div class="col-4 pt-3 ps-0">
                        <img src="{{ asset('/assets/img/illustrations/girl-doing-yoga-light.png') }}" width="100"
                            class="rounded-start" alt="View Sales">
                    </div>
                </div>
            </div>
        @endif

        @if (auth()->user()->roles == 'admin' || auth()->user()->roles == 'dosen')
            <div class="card col-md-3 mx-3 mb-3" style="gap: 10px">
                <div class="d-flex align-items-end row">
                    <div class="col-8">
                        <div class="card-body">
                            <h6 class="card-title mb-1 text-nowrap">Data Jadwal</h6>
                            <small class="d-block mb-3 text-nowrap">yang telah dibuat</small>
                            <h5 class="card-title text-primary mb-1">{{ $jadwalCount }}</h5>
                            <small class="d-block mb-4 pb-1 text-muted">Jadwal</small>
                            @if (auth()->user()->roles == 'admin')
                            <a href="{{ url('/jadwal') }}" class="btn btn-sm btn-primary">Data Jadwal</a>
                            @else

                            <button id="lihatJadwalBtn" class="btn btn-primary mb-3">Lihat Jadwal</button>
                            @endif
                        </div>
                    </div>
                    <div class="col-4 pt-3 ps-0">
                        <img src="{{ asset('/assets/img/illustrations/girl-doing-yoga-light.png') }}" width="100"
                            class="rounded-start" alt="View Sales">
                    </div>
                </div>
            </div>
        @endif

        <div class="container card mt-4">
            <div id="jadwalTable" style="display: none;">
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
                                <th scope="col">Tahun Akademik</th>
                                <th scope="col">Angkatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal as $jadwal)
                                <tr>
                                    <td>{{ $jadwal->dosen->nama }}</td>
                                    <td>{{ $jadwal->prodi }}</td>
                                    <td>{{ $jadwal->mata_kuliah }} </td>
                                    <td>{{ $jadwal->laboratorium->nama }}</td>
                                    <td>{{ $jadwal->hari }}</td>
                                    <td>{{ $jadwal->jam }}</td>
                                    <td>{{ $jadwal->semester }}</td>
                                    <td>{{ $jadwal->tahun_akademik }}</td>
                                    <td>{{ $jadwal->angkatan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Tidak ada hasil penjadwalan yang ditemukan.</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.getElementById('lihatJadwalBtn').addEventListener('click', function() {
            var jadwalTable = document.getElementById('jadwalTable');
            if (jadwalTable.style.display === 'none') {
                jadwalTable.style.display = 'block';
                this.textContent = 'Sembunyikan Jadwal';
            } else {
                jadwalTable.style.display = 'none';
                this.textContent = 'Lihat Jadwal';
            }
        });
    </script>
@endsection
