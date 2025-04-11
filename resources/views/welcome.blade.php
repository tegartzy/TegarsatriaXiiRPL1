<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome</title>


    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>

        </style>
    @endif
</head>

<body class="">
    <style>
        body {
            background-color: #e5e5ff;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            width: 100%;
            position: absolute;
            margin-top: 30px;
        }

        .logo {
            width: 100px;
            height: auto;
        }

        .navbar {
            background: #56568f;

        }

        .container {
            display: flex;
            flex-direction: column;
            /* ini penting */
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }


        .logoBesar {
            width: 500px;
            height: auto;
            align-content: center;

        }
    </style>
    @if (Route::has('login'))
        <nav class="navbar navbar-expand-lg navbar-dark  px-4 py-3 d-flex">
            <img class="logo" src="{{ asset('storage/logo/logoFull.png') }}" alt="logo">

            <div class="-mx-3 flex flex-1 justify-end">


                @auth
                    <a href="{{ route('tugas.read') }}" class="btn btn-primary mx-2">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary mx-2">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary mx-2">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        </nav>
    @endif


    <div class="container mt">
        <img class="logoBesar" src="{{ asset('storage/logo/logoFull.png') }}" alt="logo">
        <div class="text-center mt-4" style="clear: both;">
            <p class="fw-bold fs-5">
                Dari tugas tugas kecil ke mimpi yang besar. Yuk tumbuh bareng, satu centang satu langkah masa depan
                cerah.
            </p>
        </div>
        @if (Route::has('login'))
        <div class="mt-4">
            @auth
                <a href="{{ route('tugas.read') }}" class="btn btn-primary mx-2">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary mx-2">
                    Log in
                </a>
        
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary mx-2">
                        Register
                    </a>
                @endif
            @endauth
        </div>
        
    @endif
    </div>

    <footer class="text-center bg-gray-800 text-white">
        <p>Alamat email: <a href="tegarsatria106@gmail.com">tegarsatria106@gmail.com</a> Nomor telepon: <a
                href="tel:+6289516088293">+6289516088293</a></p>
        <p>&copy; 2025 Tegar satria. All rights reserved.</p>
        {{-- <p><a href="#">Link ke halaman lain</a></p> --}}
    </footer>
