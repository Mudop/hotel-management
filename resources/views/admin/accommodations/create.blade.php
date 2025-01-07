@extends('layouts.app')

@section('content')
<h1>Crear Nueva Acomodación</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('accommodations.store') }}" method="POST">
    @csrf
    <label for="hotel_id">Hotel:</label>
    <select name="hotel_id" id="hotel_id" onchange="updateRoomTypes()" required>
        <option value="">Seleccione un hotel</option>
        @foreach ($hotels as $hotel)
            <option value="{{ $hotel->id }}" data-rooms="{{ $hotel->rooms->toJson() }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                {{ $hotel->name }}
            </option>
        @endforeach
    </select>

    <label for="room_type_id">Tipo de Habitación:</label>
    <select name="room_type_id" id="room_type_id" required>
        <option value="">Seleccione un tipo de habitación</option>
    </select>

    <label for="accommodation_type">Tipo de Acomodación:</label>
    <select name="accommodation_type" id="accommodation_type" required>
        <option value="">Seleccione una acomodación</option>
        <option value="Sencilla" {{ old('accommodation_type') == 'Sencilla' ? 'selected' : '' }}>Sencilla</option>
        <option value="Doble" {{ old('accommodation_type') == 'Doble' ? 'selected' : '' }}>Doble</option>
        <option value="Triple" {{ old('accommodation_type') == 'Triple' ? 'selected' : '' }}>Triple</option>
        <option value="Cuádruple" {{ old('accommodation_type') == 'Cuádruple' ? 'selected' : '' }}>Cuádruple</option>
    </select>

    <label for="quantity">Cantidad:</label>
    <input type="number" name="quantity" id="quantity" min="1" value="{{ old('quantity') }}" required>

    <button type="submit">Guardar</button>
</form>

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
