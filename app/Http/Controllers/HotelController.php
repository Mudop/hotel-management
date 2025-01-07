<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\RoomType;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Lista todos los hoteles con sus tipos de habitación.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $hotels = Hotel::with('rooms.roomType')->get();
        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        $roomTypes = RoomType::all();
        return view('admin.hotels.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:hotels,name',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'nit' => 'required|string|max:20|unique:hotels,nit',
            'total_rooms' => 'required|integer|min:1',
            'room_types.*.type' => 'required|exists:room_types,id',
            'room_types.*.accommodation' => 'required|string',
            'room_types.*.quantity' => 'required|integer|min:1',
        ]);

        $totalRoomCount = array_sum(array_column($request->room_types, 'quantity'));

        if ($totalRoomCount > $request->total_rooms) {
            return back()->withErrors(['El total de habitaciones configuradas excede el límite del hotel.'])->withInput();
        }

        try {
            $hotel = Hotel::create($request->only(['name', 'address', 'city', 'nit', 'total_rooms']));

            foreach ($request->room_types as $roomType) {
                HotelRoom::create([
                    'hotel_id' => $hotel->id,
                    'room_type_id' => $roomType['type'],
                    'accommodation' => $roomType['accommodation'],
                    'quantity' => $roomType['quantity'],
                ]);
            }

            return redirect()->route('hotels.index')->with('success', 'Hotel creado con éxito.');
        } catch (\Exception $e) {
            return back()->withErrors(['Ocurrió un error al guardar el hotel: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Elimina un hotel y sus habitaciones asociadas.
     *
     * @param \App\Models\Hotel $hotel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Hotel $hotel)
    {
        try {
            $hotel->delete();
            return redirect()->route('hotels.index')->with('success', 'Hotel eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('hotels.index')->withErrors(['No se pudo eliminar el hotel: ' . $e->getMessage()]);
        }
    }
}
