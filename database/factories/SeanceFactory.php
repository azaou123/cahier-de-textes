<?php

namespace Database\Factories;

use App\Models\Seance;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeanceFactory extends Factory
{
    protected $model = Seance::class;

    public function definition()
    {
        return [
            'Date_Seance' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'Heure_Debut' => $this->faker->time('H:i:s'),
            'Heure_Fin' => $this->faker->time('H:i:s'),
            'ID_Cours' => \App\Models\Cours::inRandomOrder()->first()->ID_Cours, // Random course
            'ID_Salle' => \App\Models\Salle::inRandomOrder()->first()->ID_Salle, // Random salle
            'description' => $this->faker->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}