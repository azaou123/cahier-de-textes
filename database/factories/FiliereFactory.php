<?php

namespace Database\Factories;

use App\Models\Filiere;
use Illuminate\Database\Eloquent\Factories\Factory;

class FiliereFactory extends Factory
{
    protected $model = Filiere::class;

    public function definition()
    {
        return [
            'Nom_Filiere' => $this->faker->word,
            'Description' => $this->faker->sentence,
            'Responsable_Filiere' => null, // Initially null, will be updated later
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}