@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg p-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Registrar Nueva Acomodación</h1>

    <!-- Mostrar errores -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded shadow-md mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario -->
    <form action="{{ route('accommodations.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Hotel -->
            <div>
                <label for="hotel_id" class="block text-gray-700 font-medium mb-2">Hotel:</label>
                <select name="hotel_id" id="hotel_id" onchange="updateRoomTypes()" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" required>
                    <option value="">Seleccione un hotel</option>
                    @foreach ($hotels as $hotel)
                        <option value="{{ $hotel->id }}" data-rooms="{{ $hotel->rooms->toJson() }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                            {{ $hotel->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tipo de Habitación -->
            <div>
                <label for="room_type_id" class="block text-gray-700 font-medium mb-2">Tipo de Habitación:</label>
                <select name="room_type_id" id="room_type_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" required>
                    <option value="">Seleccione un tipo de habitación</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Tipo de Acomodación -->
            <div>
                <label for="accommodation_type" class="block text-gray-700 font-medium mb-2">Tipo de Acomodación:</label>
                <select name="accommodation_type" id="accommodation_type" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" required>
                    <option value="">Seleccione una acomodación</option>
                    <option value="Sencilla" {{ old('accommodation_type') == 'Sencilla' ? 'selected' : '' }}>Sencilla</option>
                    <option value="Doble" {{ old('accommodation_type') == 'Doble' ? 'selected' : '' }}>Doble</option>
                    <option value="Triple" {{ old('accommodation_type') == 'Triple' ? 'selected' : '' }}>Triple</option>
                    <option value="Cuádruple" {{ old('accommodation_type') == 'Cuádruple' ? 'selected' : '' }}>Cuádruple</option>
                </select>
            </div>

            <!-- Cantidad -->
            <div>
                <label for="quantity" class="block text-gray-700 font-medium mb-2">Cantidad:</label>
                <input type="number" name="quantity" id="quantity" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" min="1" value="{{ old('quantity') }}" required>
            </div>
        </div>

        <!-- Botones -->
        <div class="flex justify-end space-x-4 mt-6">
            <a href="{{ route('accommodations.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-all">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-all">
                Guardar
            </button>
        </div>
    </form>
</div>

<script>
    function updateRoomTypes() {
        const hotelSelect = document.getElementById('hotel_id');
        const roomTypeSelect = document.getElementById('room_type_id');
        const selectedOption = hotelSelect.options[hotelSelect.selectedIndex];
        const rooms = JSON.parse(selectedOption.getAttribute('data-rooms') || '[]');

        // Limpiar opciones anteriores
        roomTypeSelect.innerHTML = '<option value="">Seleccione un tipo de habitación</option>';

        // Agregar nuevas opciones
        rooms.forEach(room => {
            const option = document.createElement('option');
            option.value = room.room_type_id;
            option.textContent = `${room.room_type.name} (Disponible: ${room.quantity})`;
            roomTypeSelect.appendChild(option);
        });
    }
</script>
@endsection
