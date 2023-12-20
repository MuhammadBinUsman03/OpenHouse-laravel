<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Inserting 10 sample group records with dummy data
        for ($i = 1; $i <= 10; $i++) {
            DB::table('groups')->insert([
                'group_login' => 'group' . $i,
                'group_password' => bcrypt('group' . $i),
                'project_id' => $i, // Assuming you have projects with IDs 1 to 5
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
