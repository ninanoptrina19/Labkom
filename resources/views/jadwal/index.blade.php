@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        <h1>Daftar Jadwal</h1>

        <a href="{{ route('data_jadwal.create') }}" class="btn btn-primary mb-3">Tambah Jadwal</a>

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
                            <th scope="col">penggunaan</th>
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
                        @foreach ($jadwal as $schedule)
                            <tr>
                                <td>{{ $schedule->dosen->nama }}</td>
                                <td>{{ $schedule->prodi }}</td>
                                <td>{{ $schedule->penggunaan }}</td>
                                <td>{{ $schedule->laboratorium->nama }}</td>
                                <td>{{ $schedule->hari }}</td>
                                <td>{{ $schedule->jam }}</td>
                                <td>{{ $schedule->semester }}</td>
                                <td>{{ $schedule->tahun_akademik }}</td>
                                <td>{{ $schedule->angkatan }}</td>
                                <td>{{ $schedule->keterangan }}</td>
                                @if (Auth::user()->roles == 'admin')
                                    <td>
                                        <a href="{{ route('data_jadwal.edit', $schedule->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal" data-id="{{ $schedule->id }}">Hapus</button>
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

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" action="" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#confirmDeleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var action = "{{ route('data_jadwal.destroy', '') }}/" + id;
            var modal = $(this)
            modal.find('#deleteForm').attr('action', action)
        })
    </script>
@endsection
