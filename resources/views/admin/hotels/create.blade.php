@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 mt-6">
    <div class="bg-white p-8 rounded-lg shadow-lg border border-gray-200">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center border-b-2 border-decameronBlue pb-4">Crear Nuevo Hotel</h1>

        <!-- Mensaje de errores -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario -->
        <form action="{{ route('hotels.store') }}" method="POST">
            @csrf

            <!-- Información del Hotel -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre del Hotel</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-decameronBlue focus:border-decameronBlue p-3"
                           placeholder="Ej. Hotel Paraíso" required>
                </div>
                <div>
                    <label for="address" class="block text-gray-700 font-semibold mb-2">Dirección</label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-decameronBlue focus:border-decameronBlue p-3"
                           placeholder="Ej. Calle 123 #45-67" required>
                </div>
                <div>
                    <label for="city" class="block text-gray-700 font-semibold mb-2">Ciudad</label>
                    <input type="text" id="city" name="city" value="{{ old('city') }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-decameronBlue focus:border-decameronBlue p-3"
                           placeholder="Ej. Bogotá" required>
                </div>
                <div>
                    <label for="nit" class="block text-gray-700 font-semibold mb-2">NIT</label>
                    <input type="text" id="nit" name="nit" value="{{ old('nit') }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-decameronBlue focus:border-decameronBlue p-3"
                           placeholder="Ej. 1234567890" required>
                </div>
                <div>
                    <label for="total_rooms" class="block text-gray-700 font-semibold mb-2">Total de Habitaciones</label>
                    <input type="number" id="total_rooms" name="total_rooms" value="{{ old('total_rooms') }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-decameronBlue focus:border-decameronBlue p-3"
                           placeholder="Ej. 100" required>
                </div>
            </div>

            <!-- Tipos de Habitación -->
            <div class="bg-gray-50 p-6 rounded-lg mb-6 shadow-inner border border-gray-200">
                <h3 class="text-2xl font-bold text-decameronBlue mb-4">Tipos de Habitación</h3>
                <div id="room-types-container" class="space-y-4">
                    <div class="room-type grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Tipo</label>
                            <select name="room_types[0][type]"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-decameronBlue focus:border-decameronBlue p-3" required>
                                @foreach ($roomTypes as $roomType)
                                    <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Acomodación</label>
                            <select name="room_types[0][accommodation]"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-decameronBlue focus:border-decameronBlue p-3" required>
                                <option value="Sencilla">Sencilla</option>
                                <option value="Doble">Doble</option>
                                <option value="Triple">Triple</option>
                                <option value="Cuádruple">Cuádruple</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Cantidad</label>
                            <input type="number" name="room_types[0][quantity]"
                                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-decameronBlue focus:border-decameronBlue p-3"
                                   placeholder="Ej. 5" required>
                        </div>
                    </div>
                </div>
                <button type="button" id="add-room-type"
                        class="mt-4 bg-decameronGold text-white px-6 py-2 rounded-lg shadow-md hover:bg-decameronBlue hover:shadow-lg transition-all">
                    + Agregar Tipo de Habitación
                </button>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('hotels.index') }}"
                   class="bg-gray-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-gray-700 transition-all">
                    Cancelar
                </a>
                <button type="submit"
                        class="bg-decameronBlue text-white px-6 py-2 rounded-lg shadow-md hover:bg-decameronGold transition-all">
                    Guardar Hotel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('add-room-type').addEventListener('click', function () {
        const container = document.getElementById('room-types-container');
        const index = container.children.length;

        const roomTypeTemplate = `
            <div class="room-type grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Tipo</label>
                    <select name="room_types[${index}][type]"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-decameronBlue focus:border-decameronBlue p-3" required>
                        @foreach ($roomTypes as $roomType)
                            <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Acomodación</label>
                    <select name="room_types[${index}][accommodation]"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-decameronBlue focus:border-decameronBlue p-3" required>
                        <option value="Sencilla">Sencilla</option>
                        <option value="Doble">Doble</option>
                        <option value="Triple">Triple</option>
                        <option value="Cuádruple">Cuádruple</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Cantidad</label>
                    <input type="number" name="room_types[${index}][quantity]"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-decameronBlue focus:border-decameronBlue p-3"
                           placeholder="Ej. 5" required>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', roomTypeTemplate);
    });
</script>
@endsection
