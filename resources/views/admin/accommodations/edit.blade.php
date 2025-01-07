@extends('layouts.app')

@section('content')
<h1>Editar Acomodación</h1>

<form action="{{ route('accommodations.update', $accommodation->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="hotel_id">Hotel:</label>
    <select name="hotel_id" id="hotel_id" required>
        <option value="">Seleccione un hotel</option>
        @foreach ($hotels as $hotel)
            <option value="{{ $hotel->id }}" {{ $accommodation->hotel_id == $hotel->id ? 'selected' : '' }}>{{ $hotel->name }}</option>
        @endforeach
    </select>

    <label for="room_type_id">Tipo de Habitación:</label>
    <select name="room_type_id" id="room_type_id" required>
        <option value="">Seleccione un tipo de habitación</option>
        @foreach ($roomTypes as $roomType)
            <option value="{{ $roomType->id }}" {{ $accommodation->room_type_id == $roomType->id ? 'selected' : '' }}>{{ $roomType->name }}</option>
        @endforeach
    </select>

    <label for="accommodation_type">Tipo de Acomodación:</label>
    <select name="accommodation_type" id="accommodation_type" required>
        <option value="">Seleccione un tipo de acomodación</option>
        @foreach (['Sencilla', 'Doble', 'Triple', 'Cuádruple'] as $type)
            <option value="{{ $type }}" {{ $accommodation->accommodation_type == $type ? 'selected' : '' }}>{{ $type }}</option>
        @endforeach
    </select>

    <label for="quantity">Cantidad:</label>
    <input type="number" name="quantity" id="quantity" value="{{ $accommodation->quantity }}" required>

    <button type="submit">Actualizar</button>
</form>

<script>
    const accommodationsByRoomType = {
        "1": ["Sencilla", "Doble"],        // Estándar
        "2": ["Triple", "Cuádruple"],      // Junior
        "3": ["Sencilla", "Doble", "Triple"] // Suite
    };

    const roomTypeSelect = document.getElementById('room_type_id');
    const accommodationSelect = document.getElementById('accommodation_type');

    function updateAccommodationOptions(roomTypeId) {
        accommodationSelect.innerHTML = '<option value="">Seleccione un tipo de acomodación</option>';

        if (roomTypeId && accommodationsByRoomType[roomTypeId]) {
            accommodationsByRoomType[roomTypeId].forEach(accommodation => {
                const option = document.createElement('option');
                option.value = accommodation;
                option.textContent = accommodation;
                accommodationSelect.appendChild(option);
            });

            // Preseleccionar el valor actual si existe
            const currentAccommodation = "{{ $accommodation->accommodation_type }}";
            accommodationSelect.value = currentAccommodation;
        }
    }

    roomTypeSelect.addEventListener('change', function () {
        updateAccommodationOptions(this.value);
    });

    // Inicializar opciones al cargar la página
    updateAccommodationOptions(roomTypeSelect.value);
</script>
@endsection
