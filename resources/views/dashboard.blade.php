<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Decameron</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex flex-col">
        <header class="w-full bg-gradient-to-r from-decameronBlue to-decameronGold text-white py-4 shadow-md">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Decameron Logo" class="h-10 mr-4">
                    <h1 class="text-2xl font-bold">Decameron Admin</h1>
                </div>
                <nav class="flex space-x-4">
                    <a href="{{ route('hotels.index') }}" class="text-white hover:text-decameronGold font-semibold">
                        Gestión de Hoteles
                    </a>
                    <a href="{{ route('accommodations.index') }}" class="text-white hover:text-decameronGold font-semibold">
                        Gestión de Acomodaciones
                    </a>
                </nav>
            </div>
        </header>

        <main class="container mx-auto px-4 mt-8 flex-grow">
            <h2 class="text-xl font-bold text-gray-700 mb-4">Bienvenido, Administrador</h2>
            <p class="text-gray-600 mb-8">Aquí puedes gestionar los hoteles y sus acomodaciones.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700">Hoteles</h3>
                    <p class="text-sm text-gray-500">Gestiona los hoteles registrados en el sistema.</p>
                    <a href="{{ route('hotels.index') }}" class="mt-4 block text-center bg-decameronBlue text-white py-2 rounded-lg hover:bg-decameronGold">
                        Ver Hoteles
                    </a>
                </div>

                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700">Acomodaciones</h3>
                    <p class="text-sm text-gray-500">Gestiona los tipos de habitaciones y sus detalles.</p>
                    <a href="{{ route('accommodations.index') }}" class="mt-4 block text-center bg-decameronBlue text-white py-2 rounded-lg hover:bg-decameronGold">
                        Ver Acomodaciones
                    </a>
                </div>
            </div>
        </main>

        <footer class="w-full bg-gray-800 text-gray-300 py-4 mt-12 text-center">
            <p>&copy; 2025 Decameron Admin. Todos los derechos reservados.</p>
            <p>Desarrollado por <span class="text-decameronGold font-bold">Joan Sebastian Parra</span></p>
        </footer>
    </div>
</body>
</html>
