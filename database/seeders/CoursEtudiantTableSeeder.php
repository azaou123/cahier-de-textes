<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CoursEtudiant;
use App\Models\Cours;
use App\Models\User;

class CoursEtudiantTableSeeder extends Seeder
{
    public function run(): void
    {
        // Get all courses and students
        $courses = Cours::pluck('ID_Cours')->toArray();
        $students = User::where('Role', 'etudiant')->pluck('ID_Utilisateur')->toArray();

        // Ensure we don't exceed the maximum possible unique combinations
        $maxRelationships = min(count($courses) * count($students), 500);

        // Track inserted combinations to avoid duplicates
        $insertedCombinations = [];

        for ($i = 0; $i < $maxRelationships; $i++) {
            do {
                // Randomly select a course and student
                $courseId = $courses[array_rand($courses)];
                $studentId = $students[array_rand($students)];

                // Check if the combination already exists
                $combination = "$courseId-$studentId";
            } while (in_array($combination, $insertedCombinations));

            // Insert the unique combination
            CoursEtudiant::create([
                'ID_Cours' => $courseId,
                'ID_Utilisateur' => $studentId,
            ]);

            // Track the inserted combination
            $insertedCombinations[] = $combination;
        }
    }
}