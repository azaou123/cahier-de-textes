<?php

namespace Database\Factories;

use App\Models\Devoir;
use App\Models\Cours;
use Illuminate\Database\Eloquent\Factories\Factory;

class DevoirFactory extends Factory
{
    protected $model = Devoir::class;

    public function definition()
    {
        // Example assignment titles and descriptions
        $assignmentTitles = [
            'Homework on Algebra',
            'Essay on Modern History',
            'Lab Report on Chemical Reactions',
            'Programming Assignment on Data Structures',
            'Research Paper on Climate Change',
        ];

        $assignmentDescriptions = [
            'Complete the exercises on algebraic equations.',
            'Write a 1000-word essay on the causes of World War I.',
            'Conduct the experiment and submit a detailed lab report.',
            'Implement a binary search tree and submit the code.',
            'Analyze the impact of climate change on polar regions.',
        ];

        return [
            'Titre_Devoir' => $this->faker->randomElement($assignmentTitles),
            'Description_Devoir' => $this->faker->randomElement($assignmentDescriptions),
            'Date_Limite' => $this->faker->dateTimeBetween('now', '+1 month'),
            'file_path' => 'devoirs/' . $this->faker->slug . '.pdf', // More meaningful file names
            'ID_Cours' => Cours::inRandomOrder()->first()->ID_Cours, // Random course
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}