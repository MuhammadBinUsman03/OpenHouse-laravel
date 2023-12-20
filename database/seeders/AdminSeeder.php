<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'admin_name' => 'Ayesh Ahmad',
                'admin_login' => 'ayesh',
                'admin_password' => bcrypt('admin'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'admin_name' => 'Muhammad Bin Usman',
                'admin_login' => 'muhammad',
                'admin_password' => bcrypt('admin'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
