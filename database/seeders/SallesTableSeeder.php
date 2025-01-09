<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SallesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Salle::factory(10)->create(); // Create 10 salles
        \App\Models\Salle::factory(10)->create(); // Create 10 filieres
    }
}
