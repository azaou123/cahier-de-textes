<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition()
    {
        return [
            'ID_Utilisateur' => \App\Models\User::inRandomOrder()->first()->ID_Utilisateur, // Random user
            'Message' => $this->faker->sentence,
            'Date_Notification' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'Statut' => $this->faker->randomElement(['non lu', 'lu']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}