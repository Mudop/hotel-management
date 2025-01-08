@extends('layouts.app')

@section('header')
    <h1 class="text-3xl font-bold text-white">Gestión de Hoteles</h1>
@endsection

@section('content')
<div class="container mx-auto px-4 mt-6">
    <!-- Mensaje de éxito -->
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded shadow-md mb-6">
            <strong>¡Éxito!</strong> {{ session('success') }}
        </div>
    @endif

    <!-- Botón para crear nuevo hotel -->
    <div class="flex justify-end mb-6">
        <a href="{{ route('hotels.create') }}"
           class="bg-decameronGold text-white px-6 py-2 rounded-lg shadow-md hover:bg-decameronBlue hover:shadow-lg transition-transform transform hover:scale-105">
            + Crear Nuevo Hotel
        </a>
    </div>

    <!-- Tabla de hoteles -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="min-w-full border-collapse divide-y divide-gray-300">
            <thead class="bg-gradient-to-r from-decameronBlue to-decameronGold text-white">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Dirección</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Ciudad</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">NIT</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Total Habitaciones</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-gray-50 divide-y divide-gray-300">
                @foreach ($hotels as $hotel)
                    <tr class="hover:bg-gray-100 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $hotel->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $hotel->address }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $hotel->city }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $hotel->nit }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $hotel->total_rooms }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <!-- Botón Eliminar -->
                            <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-700 shadow-md hover:shadow-lg transition-transform transform hover:scale-105">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Espacio adicional para el footer -->
<div class="mt-12"></div>
@endsection
