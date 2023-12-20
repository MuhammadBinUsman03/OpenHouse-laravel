<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Inserting 10 sample project records with dummy data
        for ($i = 1; $i <= 10; $i++) {
            DB::table('projects')->insert([
                'project_name' => 'Project ' . $i,
                'project_details' => $faker->sentence,
                'project_keywords' => $faker->words(3, true),
                'location_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
