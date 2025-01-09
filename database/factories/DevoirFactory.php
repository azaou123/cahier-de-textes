<?php

namespace Database\Factories;

use App\Models\Devoir;
use Illuminate\Database\Eloquent\Factories\Factory;

class DevoirFactory extends Factory
{
    protected $model = Devoir::class;

    public function definition()
    {
        return [
            'Titre_Devoir' => $this->faker->sentence(3),
            'Description_Devoir' => $this->faker->paragraph,
            'Date_Limite' => $this->faker->dateTimeBetween('now', '+1 month'),
            'file_path' => 'devoirs/' . $this->faker->word . '.pdf',
            'ID_Cours' => \App\Models\Cours::inRandomOrder()->first()->ID_Cours, // Random course
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}