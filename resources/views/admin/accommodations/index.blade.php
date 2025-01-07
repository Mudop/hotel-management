@extends('layouts.app')

@section('content')
    <h1>Gestión de Acomodaciones</h1>
    <a href="{{ route('accommodations.create') }}" class="btn btn-primary">Registrar Nueva Acomodación</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Hotel</th>
                <th>Tipo de Habitación</th>
                <th>Tipo de Acomodación</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($accommodations as $accommodation)
                <tr>
                    <td>{{ $accommodation->id }}</td>
                    <td>{{ $accommodation->hotel->name }}</td>
                    <td>{{ $accommodation->roomType->name }}</td>
                    <td>{{ $accommodation->accommodation_type }}</td>
                    <td>{{ $accommodation->quantity }}</td>
                    <td>
                        <a href="{{ route('accommodations.edit', $accommodation->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('accommodations.destroy', $accommodation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta acomodación?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay acomodaciones registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
