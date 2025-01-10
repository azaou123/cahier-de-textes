<?php

namespace Database\Factories;

use App\Models\CourseResource;
use App\Models\Cours;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseResourceFactory extends Factory
{
    protected $model = CourseResource::class;

    public function definition()
    {
        // Example resource titles
        $resourceTitles = [
            'Introduction to Programming',
            'Advanced Calculus Notes',
            'Physics Lab Manual',
            'Chemistry Experiment Guide',
            'Literature Review Template',
            'History Research Paper',
            'Engineering Design Principles',
            'Business Case Studies',
            'Psychology Lecture Slides',
            'Data Structures and Algorithms',
        ];

        // Example resource descriptions
        $resourceDescriptions = [
            'Comprehensive guide to programming basics.',
            'Detailed notes on advanced calculus topics.',
            'Manual for conducting physics lab experiments.',
            'Step-by-step guide for chemistry experiments.',
            'Template for writing literature reviews.',
            'Research paper on historical events.',
            'Principles and practices of engineering design.',
            'Case studies for business administration.',
            'Lecture slides for psychology courses.',
            'Study material for data structures and algorithms.',
        ];

        // Example file names for resources
        $fileNames = [
            'programming_guide.pdf',
            'calculus_notes.docx',
            'physics_lab_manual.zip',
            'chemistry_experiment_guide.pdf',
            'literature_review_template.docx',
            'history_research_paper.pdf',
            'engineering_design_principles.zip',
            'business_case_studies.docx',
            'psychology_lecture_slides.pdf',
            'data_structures_algorithms.zip',
        ];

        return [
            'ID_Cours' => Cours::inRandomOrder()->first()->ID_Cours, // Random course
            'title' => $this->faker->randomElement($resourceTitles), // More meaningful title
            'description' => $this->faker->randomElement($resourceDescriptions), // More meaningful description
            'file_path' => 'resources/' . $this->faker->randomElement($fileNames), // More meaningful file names
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}