<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Accommodation;

class AccommodationsSeeder extends Seeder
{
    public function run()
    {
        $accommodations = [
            [
                'hotel_id' => 1, // Cambia los IDs según tus datos
                'room_type_id' => 1,
                'accommodation_type' => 'Normal',
                'quantity' => 10,
            ],
            [
                'hotel_id' => 2,
                'room_type_id' => 2,
                'accommodation_type' => 'Premium',
                'quantity' => 5,
            ],
        ];

        foreach ($accommodations as $accommodation) {
            Accommodation::create($accommodation);
        }
    }
}
