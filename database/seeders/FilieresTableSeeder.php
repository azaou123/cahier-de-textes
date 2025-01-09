<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Filiere;
use App\Models\User; // Correct namespace for the User model

class FilieresTableSeeder extends Seeder
{
    public function run(): void
    {
        // Get a random professor (user with Role = 'professeur')
        $professeur = \App\Models\User::where('Role', 'professeur')->inRandomOrder()->first();

        if (!$professeur) {
            throw new \Exception('No professor found. Ensure the UsersTableSeeder creates at least one professor.');
        }

        // Create 10 filieres with the random professor as the Responsable_Filiere
        \App\Models\Filiere::factory(10)->create([
            'Responsable_Filiere' => $professeur->ID_Utilisateur,
        ]);
    }
}
