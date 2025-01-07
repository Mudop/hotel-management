<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * Muestra los tipos de habitación asignados a un hotel.
     */
    public function index(Hotel $hotel)
    {
        $roomTypes = $hotel->roomTypes()->get();
        return view('admin.room_types.index', compact('hotel', 'roomTypes'));
    }

    /**
     * Muestra el formulario para asignar tipos de habitación.
     */
    public function create(Hotel $hotel)
    {
        $availableRoomTypes = RoomType::all();
        return view('admin.room_types.create', compact('hotel', 'availableRoomTypes'));
    }

    /**
     * Asigna un tipo de habitación a un hotel.
     */
    public function store(Request $request, Hotel $hotel)
    {
        $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $roomType = RoomType::findOrFail($request->room_type_id);

        // Validar si la cantidad total no supera el máximo permitido por el hotel
        if (!$hotel->canAddRooms($request->quantity)) {
            return redirect()->back()->withErrors(['quantity' => 'La cantidad total de habitaciones supera el máximo permitido para este hotel.']);
        }

        // Evitar duplicados para el mismo tipo de habitación
        if ($hotel->roomTypes()->where('room_type_id', $roomType->id)->exists()) {
            return redirect()->back()->withErrors(['room_type_id' => 'Este tipo de habitación ya está asignado al hotel.']);
        }

        $hotel->roomTypes()->attach($roomType->id, ['quantity' => $request->quantity]);

        return redirect()->route('hotels.show', $hotel->id)->with('success', 'Tipo de habitación asignado con éxito.');
    }

    /**
     * Elimina un tipo de habitación asignado a un hotel.
     */
    public function destroy(Hotel $hotel, RoomType $roomType)
    {
        $hotel->roomTypes()->detach($roomType->id);

        return redirect()->route('hotels.show', $hotel->id)->with('success', 'Tipo de habitación eliminado con éxito.');
    }
}
