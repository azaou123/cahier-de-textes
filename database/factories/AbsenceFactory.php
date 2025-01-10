<?php

namespace Database\Factories;

use App\Models\Absence;
use App\Models\User;
use App\Models\Seance;
use Illuminate\Database\Eloquent\Factories\Factory;

class AbsenceFactory extends Factory
{
    protected $model = Absence::class;

    public function definition()
    {
        // Example justifications for absences
        $justifications = [
            'Medical appointment',
            'Family emergency',
            'Transport issues',
            'Illness',
            'Personal reasons',
        ];

        return [
            'ID_Utilisateur' => User::where('Role', 'etudiant')->inRandomOrder()->first()->ID_Utilisateur, // Random student
            'ID_Seance' => Seance::inRandomOrder()->first()->ID_Seance, // Random seance
            'Justificatif' => $this->faker->optional(0.6)->randomElement($justifications), // 60% chance of having a justification
            'Statut' => $this->faker->randomElement(['justifiée', 'non justifiée']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}