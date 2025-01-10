<?php

namespace Database\Factories;

use App\Models\Cours;
use App\Models\Filiere;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoursFactory extends Factory
{
    protected $model = Cours::class;

    public function definition()
    {
        // Example course prefixes and suffixes
        $coursePrefixes = ['Introduction to', 'Advanced', 'Fundamentals of', 'Principles of'];
        $courseSubjects = ['Computer Science', 'Mathematics', 'Physics', 'Chemistry', 'Biology', 'Literature', 'History'];

        $courseName = $this->faker->randomElement($coursePrefixes) . ' ' . $this->faker->randomElement($courseSubjects);

        // Example course descriptions
        $courseDescriptions = [
            'Introduction to Computer Science' => 'This course covers the basics of computer science, including programming, algorithms, and data structures.',
            'Advanced Mathematics' => 'An in-depth exploration of advanced mathematical concepts and their applications.',
            'Fundamentals of Physics' => 'This course introduces the fundamental principles of physics, including mechanics, thermodynamics, and electromagnetism.',
            'Principles of Chemistry' => 'A comprehensive study of chemical principles, including atomic structure, bonding, and reactions.',
            'Introduction to Biology' => 'This course provides an overview of biological concepts, including cell biology, genetics, and evolution.',
            'Fundamentals of Literature' => 'An exploration of literary techniques, genres, and critical analysis.',
            'Advanced History' => 'This course delves into significant historical events and their impact on modern society.',
        ];

        $description = $courseDescriptions[$courseName] ?? $this->faker->paragraph(3, true);

        return [
            'Nom_Cours' => $courseName,
            'Description_Cours' => $description, // More meaningful description
            'ID_Filiere' => Filiere::inRandomOrder()->first()->ID_Filiere, // Random filiere
            'ID_Professeur' => User::where('Role', 'professeur')->inRandomOrder()->first()->ID_Utilisateur, // Random professor
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}