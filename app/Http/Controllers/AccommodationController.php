<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Hotel;
use App\Models\HotelRoom;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccommodationController extends Controller
{
    public function index()
    {
        $accommodations = Accommodation::with(['hotel', 'roomType'])->get();
        return view('admin.accommodations.index', compact('accommodations'));
    }

    public function create()
    {
        $hotels = Hotel::with('rooms.roomType')->get();
        return view('admin.accommodations.create', compact('hotels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_type_id' => 'required|exists:hotel_rooms,room_type_id',
            'accommodation_type' => [
                'required',
                Rule::in(['Sencilla', 'Doble', 'Triple', 'Cuádruple']),
            ],
            'quantity' => 'required|integer|min:1',
        ]);

        $hotel = Hotel::with('rooms')->find($request->hotel_id);

        // Verificar si el tipo de habitación pertenece al hotel
        $room = $hotel->rooms->where('room_type_id', $request->room_type_id)->first();

        if (!$room) {
            return redirect()->back()->withErrors([
                'room_type_id' => 'El hotel seleccionado no tiene habitaciones de este tipo.',
            ])->withInput();
        }

        // Verificar si la cantidad supera las habitaciones disponibles
        $usedRooms = Accommodation::where('hotel_id', $request->hotel_id)
            ->where('room_type_id', $request->room_type_id)
            ->sum('quantity');

        $remainingRooms = $room->quantity - $usedRooms;

        if ($request->quantity > $remainingRooms) {
            return redirect()->back()->withErrors([
                'quantity' => "Solo quedan {$remainingRooms} habitaciones disponibles para este tipo.",
            ])->withInput();
        }

        try {
            // Crear la acomodación
            Accommodation::create($request->all());

            // Actualizar la cantidad disponible de habitaciones en hotel_rooms
            $room->quantity -= $request->quantity;
            $room->save();

            // Actualizar el total de habitaciones en el hotel
            $hotel->total_rooms -= $request->quantity;
            $hotel->save();

            return redirect()->route('accommodations.index')->with('success', 'Acomodación creada con éxito.');
        } catch (\Exception $e) {
            return back()->withErrors(['Ocurrió un error al guardar la acomodación: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit(Accommodation $accommodation)
    {
        $hotels = Hotel::with('rooms.roomType')->get();
        return view('admin.accommodations.edit', compact('accommodation', 'hotels'));
    }

    public function update(Request $request, Accommodation $accommodation)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_type_id' => 'required|exists:hotel_rooms,room_type_id',
            'accommodation_type' => [
                'required',
                Rule::in(['Sencilla', 'Doble', 'Triple', 'Cuádruple']),
            ],
            'quantity' => 'required|integer|min:1',
        ]);

        $hotel = Hotel::with('rooms')->find($request->hotel_id);

        $room = $hotel->rooms->where('room_type_id', $request->room_type_id)->first();

        if (!$room) {
            return redirect()->back()->withErrors([
                'room_type_id' => 'El hotel seleccionado no tiene habitaciones de este tipo.',
            ])->withInput();
        }

        $usedRooms = Accommodation::where('hotel_id', $request->hotel_id)
            ->where('room_type_id', $request->room_type_id)
            ->where('id', '!=', $accommodation->id)
            ->sum('quantity');

        $remainingRooms = $room->quantity - $usedRooms + $accommodation->quantity;

        if ($request->quantity > $remainingRooms) {
            return redirect()->back()->withErrors([
                'quantity' => "Solo quedan {$remainingRooms} habitaciones disponibles para este tipo.",
            ])->withInput();
        }

        try {
            $adjustment = $request->quantity - $accommodation->quantity;

            $accommodation->update($request->all());

            $room->quantity -= $adjustment;
            $room->save();

            $hotel->total_rooms -= $adjustment;
            $hotel->save();

            return redirect()->route('accommodations.index')->with('success', 'Acomodación actualizada con éxito.');
        } catch (\Exception $e) {
            return back()->withErrors(['Ocurrió un error al actualizar la acomodación: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Accommodation $accommodation)
    {
        try {
            $hotel = Hotel::find($accommodation->hotel_id);

            $room = HotelRoom::where('hotel_id', $accommodation->hotel_id)
                ->where('room_type_id', $accommodation->room_type_id)
                ->first();

            if ($room) {
                $room->quantity += $accommodation->quantity;
                $room->save();
            }

            if ($hotel) {
                $hotel->total_rooms += $accommodation->quantity;
                $hotel->save();
            }

            $accommodation->delete();

            return redirect()->route('accommodations.index')->with('success', 'Acomodación eliminada y habitaciones restauradas con éxito.');
        } catch (\Exception $e) {
            return back()->withErrors(['Ocurrió un error al eliminar la acomodación: ' . $e->getMessage()]);
        }
    }
}
