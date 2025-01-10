<?php

namespace Database\Factories;

use App\Models\Seance;
use App\Models\Cours;
use App\Models\Salle;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeanceFactory extends Factory
{
    protected $model = Seance::class;

    public function definition()
    {
        // Generate a start time between 8 AM and 6 PM
        $startTime = $this->faker->time('H:i:s', '08:00:00', '18:00:00');
        
        // Generate an end time that is 1 to 3 hours after the start time
        $endTime = date('H:i:s', strtotime($startTime) + rand(3600, 10800)); // 1 to 3 hours later

        // Example session descriptions
        $sessionDescriptions = [
            'Lecture on advanced topics.',
            'Practical lab session.',
            'Group discussion and problem-solving.',
            'Review session for upcoming exams.',
            'Guest lecture by industry expert.',
        ];

        return [
            'Date_Seance' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'Heure_Debut' => $startTime,
            'Heure_Fin' => $endTime,
            'ID_Cours' => Cours::inRandomOrder()->first()->ID_Cours, // Random course
            'ID_Salle' => Salle::inRandomOrder()->first()->ID_Salle, // Random salle
            'description' => $this->faker->randomElement($sessionDescriptions), // More meaningful description
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}