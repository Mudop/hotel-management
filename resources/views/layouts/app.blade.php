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
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen flex flex-col">
            <!-- Header -->
            <header class="w-full bg-gradient-to-r from-decameronBlue to-decameronGold text-white py-4 shadow-lg">
                <div class="container mx-auto px-4 flex justify-between items-center">
                    <h1 class="text-2xl font-bold uppercase tracking-widest">
                        Decameron Admin
                    </h1>
                    <nav class="flex space-x-6">
                        <a href="{{ route('hotels.index') }}" class="hover:text-gray-100 hover:underline">
                            Gestión de Hoteles
                        </a>
                        <a href="{{ route('accommodations.index') }}" class="hover:text-gray-100 hover:underline">
                            Gestión de Acomodaciones
                        </a>
                    </nav>
                </div>
            </header>

            <!-- Page Content -->
            <main class="container mx-auto px-4 mt-8 flex-1">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="w-full bg-gray-800 text-gray-300 py-4 text-center">
                &copy; {{ date('Y') }} Decameron Admin. Todos los derechos reservados.
            </footer>
        </div>
    </body>
</html>
