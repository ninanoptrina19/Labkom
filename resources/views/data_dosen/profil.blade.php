@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <h2>Edit Profil Dosen</h2>
            <div class="card">
                @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
                @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                <div class="card-header">
                    <h3>{{ $dosen->user->name }}</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profil.profilUpdate', $dosen->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $dosen->user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="nidn">NIDN:</label>
                            <input type="text" class="form-control" id="nidn" name="nidn" value="{{ $dosen->nidn }}">
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat:</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $dosen->alamat }}">
                        </div>

                        <div class="form-group">
                            <label for="telepon">Telepon:</label>
                            <input type="text" class="form-control" id="telepon" name="telepon" value="{{ $dosen->telepon }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $dosen->user->email }}">
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
