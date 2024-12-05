<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .logo {
                position: absolute;
                top: 100px;
                left: 50%;
                transform: translateX(-50%);
                font-size: 50px;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div>
            <div class="logo text-white drop-shadow-lg hidden sm:block">
                <a href="http://127.0.0.1:5173">
                    <div>
                        MilanBnB
                    </div>
                </a>
            </div>

            <div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
