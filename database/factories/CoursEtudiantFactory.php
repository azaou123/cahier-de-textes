<?php

namespace Database\Factories;

use App\Models\CoursEtudiant;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoursEtudiantFactory extends Factory
{
    protected $model = CoursEtudiant::class;

    public function definition()
    {
        return [
            'ID_Cours' => \App\Models\Cours::inRandomOrder()->first()->ID_Cours, // Random course
            'ID_Utilisateur' => \App\Models\User::where('Role', 'etudiant')->inRandomOrder()->first()->ID_Utilisateur, // Random student
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}