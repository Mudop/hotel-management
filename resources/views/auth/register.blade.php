<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-r from-decameronBlue to-decameronGold py-6 sm:py-12">
        <div class="w-full sm:max-w-md bg-white shadow-xl rounded-lg px-8 py-10 border-t-4 border-decameronBlue">
            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Decameron Logo" class="w-24 h-24">
                </a>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded mb-6">
                    <ul class="text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre Completo</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-decameronBlue focus:outline-none focus:border-decameronGold" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Correo Electrónico</label>
                    <input id="email" type="email" name="email" :value="old('email')" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-decameronBlue focus:outline-none focus:border-decameronGold" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Contraseña</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-decameronBlue focus:outline-none focus:border-decameronGold" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirmar Contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-decameronBlue focus:outline-none focus:border-decameronGold" />
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-decameronBlue hover:text-decameronGold hover:underline">
                        ¿Ya tienes una cuenta?
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-decameronBlue text-white font-bold rounded-lg shadow-lg hover:bg-decameronGold hover:text-decameronBlue transition-all">
                        Registrarse
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
