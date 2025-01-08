@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 mt-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Gestión de Acomodaciones</h1>

    <!-- Botón para registrar nueva acomodación -->
    <div class="flex justify-end mb-6">
        <a href="{{ route('accommodations.create') }}" 
           class="bg-decameronGold text-white px-6 py-2 rounded-lg shadow-md hover:bg-decameronBlue hover:shadow-lg transition-all">
            + Registrar Nueva Acomodación
        </a>
    </div>

    <!-- Tabla de acomodaciones -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gradient-to-r from-decameronBlue to-decameronGold text-white">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">#</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Hotel</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Tipo de Habitación</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Tipo de Acomodación</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Cantidad</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-gray-100 divide-y divide-gray-300">
                @forelse ($accommodations as $accommodation)
                    <tr class="hover:bg-gray-200 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $accommodation->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $accommodation->hotel->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $accommodation->roomType->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $accommodation->accommodation_type }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $accommodation->quantity }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            
                            <form action="{{ route('accommodations.destroy', $accommodation->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-700 shadow-md hover:shadow-lg transition-all"
                                        onclick="return confirm('¿Estás seguro de eliminar esta acomodación?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 py-4">No hay acomodaciones registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
