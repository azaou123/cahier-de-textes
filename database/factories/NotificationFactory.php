<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition()
    {
        // Example notification messages
        $messages = [
            'Your assignment has been graded.',
            'A new course has been added to your schedule.',
            'Reminder: Upcoming deadline for your project.',
            'Your account password has been updated.',
            'New message from your professor.',
            'Your request has been approved.',
            'System maintenance scheduled for tonight.',
            'Welcome to our new learning platform!',
            'Your feedback has been received.',
            'Please complete your profile information.',
        ];

        return [
            'ID_Utilisateur' => User::inRandomOrder()->first()->ID_Utilisateur, // Random user
            'Message' => $this->faker->randomElement($messages), // More meaningful message
            'Date_Notification' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'Statut' => $this->faker->randomElement(['non lu', 'lu']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}