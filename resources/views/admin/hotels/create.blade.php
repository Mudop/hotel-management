@extends('layouts.app')

@section('content')
<h1>Crear Nuevo Hotel</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('hotels.store') }}" method="POST">
    @csrf
    <label>Nombre del Hotel:</label>
    <input type="text" name="name" value="{{ old('name') }}" required>

    <label>Dirección:</label>
    <input type="text" name="address" value="{{ old('address') }}" required>

    <label>Ciudad:</label>
    <input type="text" name="city" value="{{ old('city') }}" required>

    <label>NIT:</label>
    <input type="text" name="nit" value="{{ old('nit') }}" required>

    <label>Total de Habitaciones:</label>
    <input type="number" name="total_rooms" value="{{ old('total_rooms') }}" required>

    <h3>Tipos de Habitación</h3>
    <div id="room-types-container">
        <div class="room-type">
            <label>Tipo:</label>
            <select name="room_types[0][type]" required>
                @foreach ($roomTypes as $roomType)
                    <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                @endforeach
            </select>

            <label>Acomodación:</label>
            <select name="room_types[0][accommodation]" required>
                <option value="Sencilla">Sencilla</option>
                <option value="Doble">Doble</option>
                <option value="Triple">Triple</option>
                <option value="Cuádruple">Cuádruple</option>
            </select>

            <label>Cantidad:</label>
            <input type="number" name="room_types[0][quantity]" required>
        </div>
    </div>

    <button type="button" id="add-room-type">Agregar Tipo de Habitación</button>
    <button type="submit">Guardar Hotel</button>
</form>

<script>
    document.getElementById('add-room-type').addEventListener('click', function () {
        const container = document.getElementById('room-types-container');
        const index = container.children.length;

        const roomTypeTemplate = `
            <div class="room-type">
                <label>Tipo:</label>
                <select name="room_types[${index}][type]" required>
                    @foreach ($roomTypes as $roomType)
                        <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                    @endforeach
                </select>

                <label>Acomodación:</label>
                <select name="room_types[${index}][accommodation]" required>
                    <option value="Sencilla">Sencilla</option>
                    <option value="Doble">Doble</option>
                    <option value="Triple">Triple</option>
                    <option value="Cuádruple">Cuádruple</option>
                </select>

                <label>Cantidad:</label>
                <input type="number" name="room_types[${index}][quantity]" required>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', roomTypeTemplate);
    });
</script>
@endsection
