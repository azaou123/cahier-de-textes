<?php

namespace Database\Factories;

use App\Models\RenduDevoir;
use Illuminate\Database\Eloquent\Factories\Factory;

class RenduDevoirFactory extends Factory
{
    protected $model = RenduDevoir::class;

    public function definition()
    {
        return [
            'ID_Devoir' => \App\Models\Devoir::inRandomOrder()->first()->ID_Devoir, // Random devoir
            'ID_Utilisateur' => \App\Models\User::where('Role', 'etudiant')->inRandomOrder()->first()->ID_Utilisateur, // Random student
            'Fichier_Rendu' => 'rendus/' . $this->faker->word . '.pdf',
            'Date_Rendu' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'Note' => $this->faker->optional()->randomFloat(2, 0, 20),
            'Commentaire' => $this->faker->optional()->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}