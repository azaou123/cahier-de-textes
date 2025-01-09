<?php

namespace Database\Factories;

use App\Models\Absence;
use Illuminate\Database\Eloquent\Factories\Factory;

class AbsenceFactory extends Factory
{
    protected $model = Absence::class;

    public function definition()
    {
        return [
            'ID_Utilisateur' => \App\Models\User::where('Role', 'etudiant')->inRandomOrder()->first()->ID_Utilisateur, // Random student
            'ID_Seance' => \App\Models\Seance::inRandomOrder()->first()->ID_Seance, // Random seance
            'Justificatif' => $this->faker->optional()->sentence,
            'Statut' => $this->faker->randomElement(['justifiée', 'non justifiée']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}