<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DevoirsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Devoir::factory(100)->create(); // Create 100 devoirs
        \App\Models\Devoir::factory(100)->create(); // Create 10 filieres
    }
}
