<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Notification::factory(500)->create(); // Create 500 notifications
        \App\Models\Notification::factory(500)->create(); // Create 10 filieres
    }
}
