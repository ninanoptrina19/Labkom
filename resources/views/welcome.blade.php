<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> SISTEM PENJADWALAN PRAKTIKUM LAB</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: #f3f4f6;
            color: #333;
        }

        .container {
            max-width: 960px;
            margin: auto;
            padding: 2rem;
        }

        .navbar-container {
            width: 100%;
            padding: 1rem 2rem;
            background: #fff;
            border-bottom: 1px solid #eaeaea;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 960px;
            margin: auto;
        }

        .navbar a {
            color: #007bff;
            font-weight: 600;
            text-decoration: none;
            margin: 0 0.5rem;
        }

        .navbar a.gray {
            color: #666;
        }

        .header-content {
            margin-top: 6rem; /* Adjusted for navbar height */
            text-align: center;
        }

        .header-content h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .header-content p {
            font-size: 1.125rem;
            color: #666;
            margin-bottom: 2rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .card {
            margin-top: 2rem;
        }

        /* Centering text */
        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="navbar-container">
        <div class="navbar">
            <div class="col-4 pt-3 ps-2">
                <img src="{{ asset('/assets/img/illustrations/INFORMATIKA.png') }}"
                  class="img-fluid" alt="Sample image">
              </div>
            <div class="navbar-left">
                {{-- <h3 class="text-bold">PENJADWALAN LAB</h3> --}}
            </div>
            <div class="navbar-right d-flex">
                @if (Route::has('login'))
                    @auth
                        @if (Auth::user()->roles == 'admin')
                            <a href="{{ url('/home') }}" class="gray">Home</a>
                        @else
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="#" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}">Log in</a>
                        
                    @endauth
                @endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="header-content mb-5">
            <h2 class="fw-bold">Selamat Datang Pada Penjadwalan Praktikum Labkom</h2>
            <p>Sistem ini dirancang untuk membantu dosen dalam mengatur jadwal praktikum mereka dengan mudah dan efisien. Dengan menggunakan sistem ini, Anda dapat memeriksa dan memilih jadwal yang sesuai dengan kebutuhan Anda.</p>
            @auth
                <a href="{{route('form.diagnosa')}}" class="btn btn-primary">Mulai Penjadwalan</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Login Untuk Membuat Jadwal</a>
            @endauth
        </div>

      <div class="card shadow border-o p-3">
        @if (count($jadwal) > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Hari</th>
                        <th scope="col">Jam</th>
                        <th scope="col">Laboratorium</th>
                        <th scope="col">Penggunaan/Mata_Kuliah</th>
                        <th scope="col">Dosen</th>
                        <th scope="col">Prodi</th>
                        <th scope="col">Tanggal_Mulai</th>
                        <th scope="col">Tanggal_Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwal as $schedule)
                        <tr>
                            <td>{{ $schedule->hari }}</td>
                            <td>{{ $schedule->jam }}</td>
                            <td>{{ $schedule->laboratorium->nama }}</td>
                            <td>{{ $schedule->penggunaan }}</td>
                            <td>{{ $schedule->dosen->nama }}</td>
                            <td>{{ $schedule->prodi }}</td>
                            <td>{{ $schedule->tanggal_mulai }}</td>
                            <td>{{ $schedule->tanggal_selesai }}</td>
                           
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>Tidak ada hasil penjadwalan yang ditemukan.</p>
    @endif
      </div>
    </div>
</body>