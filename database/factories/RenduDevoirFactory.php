<?php

namespace Database\Factories;

use App\Models\RenduDevoir;
use App\Models\Devoir;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RenduDevoirFactory extends Factory
{
    protected $model = RenduDevoir::class;

    public function definition()
    {
        // Example file names for submitted assignments
        $fileNames = [
            'assignment_submission.pdf',
            'homework_solution.pdf',
            'lab_report.pdf',
            'research_paper.pdf',
            'project_documentation.pdf',
        ];

        // Example comments for graded assignments
        $comments = [
            'Well done! Keep up the good work.',
            'Needs improvement in the methodology section.',
            'Excellent analysis and presentation.',
            'Please revise the conclusion part.',
            'Good effort, but more details are needed.',
        ];

        return [
            'ID_Devoir' => Devoir::inRandomOrder()->first()->ID_Devoir, // Random devoir
            'ID_Utilisateur' => User::where('Role', 'etudiant')->inRandomOrder()->first()->ID_Utilisateur, // Random student
            'Fichier_Rendu' => 'rendus/' . $this->faker->randomElement($fileNames), // More meaningful file names
            'Date_Rendu' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'Note' => $this->faker->optional(0.7)->randomFloat(2, 0, 20), // 70% chance of having a grade
            'Commentaire' => $this->faker->optional(0.5)->randomElement($comments), // 50% chance of having a comment
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}