@extends('layouts.app')

@section('content')
    <h1>Lista de Hoteles</h1>

    <!-- Mensaje de éxito -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('hotels.create') }}">Crear Nuevo Hotel</a>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>NIT</th>
                <th>Total Habitaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hotels as $hotel)
                <tr>
                    <td>{{ $hotel->name }}</td>
                    <td>{{ $hotel->address }}</td>
                    <td>{{ $hotel->city }}</td>
                    <td>{{ $hotel->nit }}</td>
                    <td>{{ $hotel->total_rooms }}</td>
                    <td>
                        
                        <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
