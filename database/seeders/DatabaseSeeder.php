<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Filiere;
use Illuminate\Database\Seeder;
use Faker\Factory; // Import Faker Factory

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a Faker instance
        $faker = Factory::create();

        // Step 1: Seed users (students, professors, admins)
        $this->call([
            UsersTableSeeder::class,
        ]);

        // Step 2: Seed filieres
        $this->call([
            FilieresTableSeeder::class,
        ]);

        // Step 3: Assign students to filieres
        $filieres = Filiere::pluck('ID_Filiere')->toArray();
        $students = User::where('Role', 'etudiant')->get();

        foreach ($students as $student) {
            $student->ID_Filiere = $faker->randomElement($filieres); // Use the Faker instance
            $student->save();
        }

        // Step 4: Seed other tables
        $this->call([
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