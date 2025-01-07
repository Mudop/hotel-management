<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelsSeeder extends Seeder
{
    public function run()
    {
        Hotel::firstOrCreate([
            'name' => 'Hotel Cartagena',
            'address' => 'Calle 23 #58-25',
            'city' => 'Cartagena',
            'nit' => '12345678-9',
            'max_rooms' => 42,
        ]);
    }
}
