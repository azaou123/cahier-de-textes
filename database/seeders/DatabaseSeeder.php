<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UsersTableSeeder::class,
            FilieresTableSeeder::class,
            CoursTableSeeder::class,
            SallesTableSeeder::class,
            SeancesTableSeeder::class,
            DevoirsTableSeeder::class,
            AbsencesTableSeeder::class,
            NotificationsTableSeeder::class,
            CourseResourcesTableSeeder::class,
            CoursEtudiantTableSeeder::class,
            RendusDevoirTableSeeder::class,
        ]);
    }
}
