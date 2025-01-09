<?php

namespace Database\Factories;

use App\Models\Cours;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoursFactory extends Factory
{
    protected $model = Cours::class;

    public function definition()
    {
        return [
            'Nom_Cours' => $this->faker->sentence(3),
            'Description_Cours' => $this->faker->paragraph,
            'ID_Filiere' => \App\Models\Filiere::inRandomOrder()->first()->ID_Filiere, // Random filiere
            'ID_Professeur' => \App\Models\User::where('Role', 'professeur')->inRandomOrder()->first()->ID_Utilisateur, // Random professor
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}