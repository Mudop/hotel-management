<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="bg-gradient-to-r from-decameronBlue to-decameronGold min-h-screen flex flex-col justify-between">
        <header class="bg-white shadow-lg py-4">
            <div class="container mx-auto px-6 flex justify-between items-center">
                <a href="/" class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Decameron Logo" class="w-12 h-12">
                    <h1 class="text-xl font-bold text-decameronBlue">Decameron Admin</h1>
                </a>
            </div>
        </header>

        <main class="flex-grow">
            <div class="container mx-auto px-4">
                {{ $slot }}
            </div>
        </main>

        <footer class="bg-gray-800 text-gray-300 py-4 text-center">
            &copy; {{ date('Y') }} Decameron Admin. Todos los derechos reservados.
        </footer>
    </body>
</html>
