<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seance::factory(200)->create(); // Create 200 seances
        \App\Models\Seance::factory(200)->create(); // Create 10 filieres
    }
}
