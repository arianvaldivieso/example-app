<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cities')->insert([
            [
                'name' => 'Ciudad Bolívar',
                'latitude' => 8.1292,
                'longitude' => -63.5409,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Caracas',
                'latitude' => 10.4806,
                'longitude' => -66.9036,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maracaibo',
                'latitude' => 10.6545,
                'longitude' => -71.6500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Valencia',
                'latitude' => 10.1620,
                'longitude' => -68.0077,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Barquisimeto',
                'latitude' => 10.0678,
                'longitude' => -69.3467,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
