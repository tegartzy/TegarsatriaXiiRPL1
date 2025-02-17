<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!--bootstrap-->
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
                        @if (Route::has('login'))
                            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 py-3 d-flex">
                                <div class="-mx-3 flex flex-1 justify-end">
                                @auth
                                    <a
                                        href="{{ route('tugas.read') }}"
                                        class="btn btn-primary mx-2"
                                    >
                                        Dashboard
                                    </a>
                                @else
                                    <a
                                        href="{{ route('login') }}"
                                        class="btn btn-primary mx-2"
                                    >
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="btn btn-primary mx-2"
                                        >
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </div>
                            </nav>
                        @endif
                    

                  