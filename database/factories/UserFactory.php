<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'Role' => $this->faker->randomElement(['professeur', 'etudiant', 'admin']),
            'ID_Filiere' => null, // Initially null, will be updated later
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}