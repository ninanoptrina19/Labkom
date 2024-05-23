@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Profil Dosen</h2>
            <div class="card">
                <div class="card-header">
                    <h3>{{ $dosen->user->name }}</h3>
                </div>
                <div class="card-body">
                    <p><strong>NIDN:</strong> {{ $dosen->nidn }}</p>
                    <p><strong>Email:</strong> {{ $dosen->user->email }}</p>
                    <p><strong>Alamat:</strong> {{ $dosen->alamat }}</p>
                    <!-- Tambahkan field lain yang diperlukan -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
