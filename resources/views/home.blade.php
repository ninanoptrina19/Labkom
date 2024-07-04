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
                            <h6 class="card-title mb-1 text-nowrap">Data Semua Jadwal</h6>
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

        @if (auth()->user()->roles == 'dosen')
        <div class="card col-md-3 mx-3 mb-3" style="gap: 10px">
            <div class="d-flex align-items-end row">
                <div class="col-8">
                    <div class="card-body">
                        <h6 class="card-title mb-1 text-nowrap">Data Jadwal Saya</h6>
                        <small class="d-block mb-3 text-nowrap">yang telah dibuat</small>
                        <h5 class="card-title text-primary mb-1">{{ $jadwalDosen->count() }}</h5>
                        <small class="d-block mb-4 pb-1 text-muted">Jadwal</small>
                    
                        <button id="lihatJadwalBtnDosen" class="btn btn-primary mb-3">Lihat Jadwal </button>
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
                <h2>Semua Jadwal Lab</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Hari</th>
                            <th scope="col">Jam</th>
                            <th scope="col">Laboratorium</th>
                            <th scope="col">Penggunaan/Mata Kuliah</th>
                            <th scope="col">Dosen</th>
                            <th scope="col">Prodi</th>
                            <th scope="col">Tahun Akademik</th>
                            <th scope="col">tanggal mulai</th>
                            <th scope="col">tanggal selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal as $jadwal)
                            <tr>
                                <td>{{ $jadwal->hari }}</td>
                                <td>{{ $jadwal->jam }}</td>
                                <td>{{ $jadwal->laboratorium->nama }}</td>
                                <td>{{ $jadwal->penggunaan }} </td>
                                <td>{{ $jadwal->dosen->nama }}</td>
                                <td>{{ $jadwal->prodi }}</td>
                                <td>{{ $jadwal->tahunAkademik->nama }}</td>
                                <td>{{ $jadwal->tanggal_mulai }}</td>
                            <td>{{ $jadwal->tanggal_selesai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if (auth()->user()->roles == 'dosen')
            <div id="jadwalTableDosen" class="mt-3"  style="display: none;">
                <h2>Jadwal Saya</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Hari</th>
                            <th scope="col">Jam</th>
                            <th scope="col">Laboratorium</th>
                            <th scope="col">Penggunaan/Mata Kuliah</th>
                            <th scope="col">Dosen</th>
                            <th scope="col">Prodi</th>
                            <th scope="col">Tahun Akademik</th>
                            <th scope="col">tanggal mulai</th>
                            <th scope="col">tanggal selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwalDosen as $jadwal)
                            <tr>
                                <td>{{ $jadwal->jam }}</td>
                                <td>{{ $jadwal->hari }}</td>
                                <td>{{ $jadwal->laboratorium->nama }}</td>
                                <td>{{ $jadwal->penggunaan }} </td>
                                <td>{{ $jadwal->dosen->nama }}</td>
                                <td>{{ $jadwal->prodi }}</td>
                                <td>{{ $jadwal->tahunAkademik->nama }}</td>
                                <td>{{ $jadwal->tanggal_mulai }}</td>
                                <td>{{ $jadwal->tanggal_selesai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
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

        document.getElementById('lihatJadwalBtnDosen').addEventListener('click', function() {
            var jadwalTableDosen = document.getElementById('jadwalTableDosen');
            if (jadwalTableDosen.style.display === 'none') {
                jadwalTableDosen.style.display = 'block';
                this.textContent = 'Sembunyikan Jadwal';
            } else {
                jadwalTableDosen.style.display = 'none';
                this.textContent = 'Lihat Jadwal';
            }
        });
    </script>
@endsection
