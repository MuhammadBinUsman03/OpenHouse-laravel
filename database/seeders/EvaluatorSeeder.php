<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Faker\Factory as Faker;

class EvaluatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Inserting 15 sample evaluator records with dummy data
        for ($i = 1; $i <= 15; $i++) {
            DB::table('evaluators')->insert([
                'evaluator_name' => $faker->name,
                'evaluator_login' => 'evaluator' . $i,
                'evaluator_password' => bcrypt('evaluator' . $i),
                'evaluator_preferences' => $faker->word,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
