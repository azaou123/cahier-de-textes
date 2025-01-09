<?php

namespace Database\Factories;

use App\Models\Salle;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalleFactory extends Factory
{
    protected $model = Salle::class;

    public function definition()
    {
        return [
            'Nom_Salle' => 'Salle ' . $this->faker->numberBetween(100, 200),
            'Capacite' => $this->faker->numberBetween(20, 50),
            'Localisation' => $this->faker->randomElement(['Bâtiment A', 'Bâtiment B', 'Bâtiment C']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}