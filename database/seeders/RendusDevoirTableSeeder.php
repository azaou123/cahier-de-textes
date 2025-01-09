<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RendusDevoirTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // RenduDevoir::factory(300)->create(); // Create 300 rendus
        \App\Models\RenduDevoir::factory(300)->create(); // Create 10 filieres
    }
}
