<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">

    <style>
        /* Menyeting margin dan padding halaman */
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        /* Container untuk menampilkan card di tengah */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        /* Card dengan padding dan border */
        .card {
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
        }

        /* Styling untuk header */
        .card h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .card label {
            font-weight: bold;
        }

        /* Menghapus margin dan padding default pada input */
        .card .input-group input,
        .card button {
            width: 100%;
            padding: 6px;

            margin: 0;

            box-sizing: border-box;

        }


        .card button {
            padding: 10px;
        }



        /* Untuk input dan tombol agar lebih rapi */
        .card .input-group input,
        .card button {
            width: 100%;
        }
    </style>

</head>

<body class="text-center">
    <div class="container">
        <div class="card">
            <h2>Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email-->
                <div class="input-group">
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username" placeholder="Email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="input-group mt-4">

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" placeholder="Password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="">{{ __('Remember me') }}
                    </label>
                </div>

                <!-- Forgot Password -->
                <div class="flex items-center justify-between mt-4">
                   
                        <a href="{{ route('register') }}">
                            {{ __('Belum punya akun?') }}
                        </a>
                    

                    <!-- Button Login -->
                    <x-primary-button class=" w-full">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
