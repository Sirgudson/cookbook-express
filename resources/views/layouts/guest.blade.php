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
    </head>
    <body>
        <main class="login__body_wrapper">
            <div class="login__container">
                <section class="login__box_logo">
                    <div class="login__box_logo-data">
                        <a href="/">
                            <img src="{{ asset('logo-cookbook.png') }}" alt="Logo" width="300">             
                        </a>
                    </div>
                </section>

                <section class="login__box-form">
                    <div class="login__box-form-data w-full sm:max-w-md px-6 py-4 overflow-hidden sm:rounded-lg z-10">
                        {{ $slot }}
                    </div>
                </section>
            </div>
        </main>
    </body>
</html>
