<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomType;

class RoomTypesSeeder extends Seeder
{
    public function run()
    {
        $roomTypes = ['Estándar', 'Junior', 'Suite'];

        foreach ($roomTypes as $type) {
            RoomType::firstOrCreate(['name' => $type]);
        }
    }
}
