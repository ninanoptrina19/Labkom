@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <h2>Profil Dosen</h2>
            <div class="card">
                <div class="card-header">
                    <h3>{{ $dosen->user->name }}</h3>
                </div>
                <div class="card-body">
                    <p><strong>NIDN:</strong> {{ $dosen->nidn }}</p>
                    <p><strong>Alamat:</strong> {{ $dosen->alamat }}</p>
                    <p><strong>Email:</strong> {{ $dosen->user->email }}</p>
                    <p><strong>Telepon:</strong> {{ $dosen->telepon }}</p>

                    <!-- Tambahkan field lain yang diperlukan -->

                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Reset Password</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Reset Password</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <p class="text-danger">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Optio, animi!</p>
                              <form action="">
                                <input type="password" class="form-control p-2 mb-3" placeholder="Password Lama">
                                <input type="password" class="form-control p-2 mb-3" placeholder="Password Baru">
                               
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Simpan Password">
                                  
                              </form>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
