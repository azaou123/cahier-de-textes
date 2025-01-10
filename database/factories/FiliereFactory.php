<?php

namespace Database\Factories;

use App\Models\Filiere;
use Illuminate\Database\Eloquent\Factories\Factory;

class FiliereFactory extends Factory
{
    protected $model = Filiere::class;

    public function definition()
    {
        // Example academic fields
        $academicFields = [
            'Computer Science',
            'Mathematics',
            'Physics',
            'Chemistry',
            'Biology',
            'Literature',
            'History',
            'Engineering',
            'Business Administration',
            'Psychology',
        ];

        // Example descriptions for each field
        $fieldDescriptions = [
            'Computer Science' => 'Study of algorithms, programming, and computational systems.',
            'Mathematics' => 'Exploration of numbers, structures, and patterns.',
            'Physics' => 'Understanding the fundamental laws of the universe.',
            'Chemistry' => 'Study of matter, its properties, and reactions.',
            'Biology' => 'Science of living organisms and their interactions.',
            'Literature' => 'Analysis of written works and their cultural significance.',
            'History' => 'Study of past events and their impact on the present.',
            'Engineering' => 'Application of scientific principles to design and build systems.',
            'Business Administration' => 'Management and operation of business organizations.',
            'Psychology' => 'Study of the mind and behavior.',
        ];

        $field = $this->faker->randomElement($academicFields);

        return [
            'Nom_Filiere' => $field,
            'Description' => $fieldDescriptions[$field], // Use a meaningful description for the selected field
            'Responsable_Filiere' => null, // Initially null, can be updated later
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}