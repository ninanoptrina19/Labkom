<!-- resources/views/data_dosens/edit.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        <h1>Edit Data User</h1>

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


        <form action="{{route('data_user.update', $user->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label for="roles">Roles:</label>
                <select class="form-control" name="roles">
                    <option value="admin" {{ $user->roles == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="dosen" {{ $user->roles == 'dosen' ? 'selected' : '' }}>Dosen</option>
                </select>
            </div>
            
            
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection