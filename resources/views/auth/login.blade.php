<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Decameron</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-decameronBlue to-decameronGold">
        <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-6">
            <div class="text-center mb-6">
                <img src="{{ asset('images/logo.png') }}" alt="Decameron Logo" class="h-16 mx-auto mb-4">
                <h2 class="text-2xl font-bold text-gray-700">Iniciar Sesión</h2>
            </div>
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                    <input id="email" name="email" type="email" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-decameronBlue focus:border-decameronBlue">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input id="password" name="password" type="password" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-decameronBlue focus:border-decameronBlue">
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox"
                            class="h-4 w-4 text-decameronBlue border-gray-300 rounded focus:ring-decameronBlue">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700">Recordarme</label>
                    </div>
                    <div>
                        <a href="{{ route('password.request') }}" class="text-sm text-decameronBlue hover:underline">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                </div>
                <button type="submit"
                    class="w-full py-2 px-4 bg-decameronBlue text-white font-bold rounded-lg shadow-md hover:bg-decameronGold focus:outline-none">
                    Iniciar Sesión
                </button>
            </form>
        </div>
    </div>
</body>
</html>
