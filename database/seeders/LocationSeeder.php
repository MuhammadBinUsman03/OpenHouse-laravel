<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $location = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
        // Inserting 10 sample location records with dummy data
        for ($i = 1; $i <= 10; $i++) {
            DB::table('locations')->insert([
                'location_name' => $location[$i-1],
                'location_is_taken' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
