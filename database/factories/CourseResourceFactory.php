<?php

namespace Database\Factories;

use App\Models\CourseResource;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseResourceFactory extends Factory
{
    protected $model = CourseResource::class;

    public function definition()
    {
        return [
            'ID_Cours' => \App\Models\Cours::inRandomOrder()->first()->ID_Cours, // Random course
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'file_path' => 'resources/' . $this->faker->word . '.pdf',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}