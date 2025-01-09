<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseResourcesTableSeeder extends Seeder
{
    public function run(): void
    {
        // Create 200 course resources
        \App\Models\CourseResource::factory(200)->create();
    }
}
