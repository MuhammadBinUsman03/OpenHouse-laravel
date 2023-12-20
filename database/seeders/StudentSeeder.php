<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Inserting 45 sample student records with dummy data
        for ($i = 1; $i <= 45; $i++) {
            DB::table('students')->insert([
                'student_name' => $faker->name,
                'group_id' => $faker->numberBetween(1, 10), // Assuming you have groups with IDs 1 to 10
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
