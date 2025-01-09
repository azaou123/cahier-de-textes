<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cours::factory(50)->create(); // Create 50 courses
        \App\Models\Cours::factory(50)->create(); // Create 10 filieres
    }
}
