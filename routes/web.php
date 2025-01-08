<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfesseurDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EtudiantDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');












    Route::prefix('admin')->group(function () {
        // Tableau de bord
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
        // Gestion des Professeurs
        Route::prefix('professeurs')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'showProfesseurs'])->name('admin.professeurs');
            Route::get('/create', [AdminDashboardController::class, 'createProfesseur'])->name('admin.professeurs.create');
            Route::post('/store', [AdminDashboardController::class, 'storeProfesseur'])->name('admin.professeurs.store');
            Route::get('/edit/{id}', [AdminDashboardController::class, 'editProfesseur'])->name('admin.professeurs.edit');
            Route::put('/update/{id}', [AdminDashboardController::class, 'updateProfesseur'])->name('admin.professeurs.update');
            Route::delete('/delete/{id}', [AdminDashboardController::class, 'deleteProfesseur'])->name('admin.professeurs.delete');
        });
    
        // Gestion des Filieres
        Route::prefix('filieres')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'showFilieres'])->name('admin.filieres');
            Route::get('/create', [AdminDashboardController::class, 'createFiliere'])->name('admin.filieres.create');
            Route::post('/store', [AdminDashboardController::class, 'storeFiliere'])->name('admin.filieres.store');
            Route::get('/edit/{id}', [AdminDashboardController::class, 'editFiliere'])->name('admin.filieres.edit');
            Route::put('/update/{id}', [AdminDashboardController::class, 'updateFiliere'])->name('admin.filieres.update');
            Route::delete('/delete/{id}', [AdminDashboardController::class, 'deleteFiliere'])->name('admin.filieres.delete');
        });

        // Gestion des Etudiants
        Route::get('/etudiants', [AdminDashboardController::class, 'showEtudiants'])->name('admin.etudiants');
        Route::get('/etudiants/create', [AdminDashboardController::class, 'createEtudiant'])->name('admin.etudiants.create');
        Route::post('/etudiants/store', [AdminDashboardController::class, 'storeEtudiant'])->name('admin.etudiants.store');
        Route::get('/etudiants/edit/{id}', [AdminDashboardController::class, 'editEtudiant'])->name('admin.etudiants.edit');
        Route::put('/etudiants/update/{id}', [AdminDashboardController::class, 'updateEtudiant'])->name('admin.etudiants.update');
        Route::delete('/etudiants/delete/{id}', [AdminDashboardController::class, 'deleteEtudiant'])->name('admin.etudiants.delete');
        Route::get('/affecter-filiere', [AdminDashboardController::class, 'showAffecterFiliereForm'])->name('admin.affecter-filiere');
        Route::post('/affecter-filiere', [AdminDashboardController::class, 'affecterFiliere'])->name('admin.affecter-filiere.store');


        // Gestion des Cours 
        Route::prefix('courses')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'showCours'])->name('admin.courses'); // Liste des cours
            Route::get('/create', [AdminDashboardController::class, 'createCours'])->name('admin.cours.create'); // Formulaire de création
            Route::post('/store', [AdminDashboardController::class, 'storeCours'])->name('admin.cours.store'); // Enregistrer un cours
            Route::get('/edit/{id}', [AdminDashboardController::class, 'editCours'])->name('admin.cours.edit'); // Formulaire de modification
            Route::put('/update/{id}', [AdminDashboardController::class, 'updateCours'])->name('admin.cours.update'); // Mettre à jour un cours
            Route::delete('/delete/{id}', [AdminDashboardController::class, 'deleteCours'])->name('admin.cours.delete'); // Supprimer un cours
        });

        Route::get('/salles', [AdminDashboardController::class, 'showSalles'])->name('admin.salles');
        Route::get('/salles/create', [AdminDashboardController::class, 'createSalle'])->name('admin.salles.create');
        Route::post('/salles/store', [AdminDashboardController::class, 'storeSalle'])->name('admin.salles.store');
        Route::get('/salles/edit/{id}', [AdminDashboardController::class, 'editSalle'])->name('admin.salles.edit');
        Route::put('/salles/update/{id}', [AdminDashboardController::class, 'updateSalle'])->name('admin.salles.update');
        Route::delete('/salles/delete/{id}', [AdminDashboardController::class, 'deleteSalle'])->name('admin.salles.delete');



        
    });














    // Professeur
    Route::get('/professeur/dashboard', [ProfesseurDashboardController::class, 'index'])->name('professeur.dashboard');

    // Gestion des Cours
    Route::prefix('professeur/courses')->group(function () {
        Route::get('/', [ProfesseurDashboardController::class, 'showCourses'])->name('professeur.courses');
        Route::get('/create', [ProfesseurDashboardController::class, 'createCourse'])->name('professeur.courses.create');
        Route::post('/store', [ProfesseurDashboardController::class, 'storeCourse'])->name('professeur.courses.store');
        Route::get('/edit/{id}', [ProfesseurDashboardController::class, 'editCourse'])->name('professeur.courses.edit');
        Route::put('/update/{id}', [ProfesseurDashboardController::class, 'updateCourse'])->name('professeur.courses.update');
        Route::delete('/delete/{id}', [ProfesseurDashboardController::class, 'deleteCourse'])->name('professeur.courses.delete');
    });

    // Gestion des Séances
    Route::prefix('professeur/sessions')->group(function () {
        Route::get('/', [ProfesseurDashboardController::class, 'showSessions'])->name('professeur.sessions');
        Route::get('/create', [ProfesseurDashboardController::class, 'createSession'])->name('professeur.sessions.create');
        Route::post('/store', [ProfesseurDashboardController::class, 'storeSession'])->name('professeur.sessions.store');
        Route::get('/edit/{id}', [ProfesseurDashboardController::class, 'editSession'])->name('professeur.sessions.edit');
        Route::put('/update/{id}', [ProfesseurDashboardController::class, 'updateSession'])->name('professeur.sessions.update');
        Route::delete('/delete/{id}', [ProfesseurDashboardController::class, 'deleteSession'])->name('professeur.sessions.delete');
    });

    // Gestion des Devoirs
    Route::prefix('professeur/homework')->group(function () {
        Route::get('/', [ProfesseurDashboardController::class, 'showHomework'])->name('professeur.homework');
        Route::get('/create', [ProfesseurDashboardController::class, 'createHomework'])->name('professeur.homework.create');
        Route::post('/store', [ProfesseurDashboardController::class, 'storeHomework'])->name('professeur.homework.store');
        Route::get('/edit/{id}', [ProfesseurDashboardController::class, 'editHomework'])->name('professeur.homework.edit');
        Route::put('/update/{id}', [ProfesseurDashboardController::class, 'updateHomework'])->name('professeur.homework.update');
        Route::delete('/delete/{id}', [ProfesseurDashboardController::class, 'deleteHomework'])->name('professeur.homework.delete');
        // Route::get('/viewSubmissions', [ProfesseurDashboardController::class, 'showSubmissions'])->name('professeur.homework.submissions');
    });

    // Gestion des Soumissions des Étudiants
    Route::prefix('professeur/submissions')->group(function () {
        Route::get('/{devoirId}', [ProfesseurDashboardController::class, 'showSubmissions'])->name('professeur.homework.submissions');
        Route::post('/grade/{submissionId}', [ProfesseurDashboardController::class, 'gradeSubmission'])->name('professeur.submissions.grade');
    });

    Route::get('/courses/{courseId}/resources', [ProfesseurDashboardController::class, 'showCourseResources'])->name('professeur.courseResources');
    Route::get('/courses/{courseId}/resources/create', [ProfesseurDashboardController::class, 'createCourseResource'])->name('professeur.courseResources.create');
    Route::post('/courses/{courseId}/resources', [ProfesseurDashboardController::class, 'storeCourseResource'])->name('professeur.courseResources.store');
    Route::get('/resources/{resourceId}/edit', [ProfesseurDashboardController::class, 'editCourseResource'])->name('professeur.courseResources.edit');
    Route::put('/resources/{resourceId}', [ProfesseurDashboardController::class, 'updateCourseResource'])->name('professeur.courseResources.update');
    Route::delete('/resources/{resourceId}', [ProfesseurDashboardController::class, 'deleteCourseResource'])->name('professeur.courseResources.delete');










    // Routes pour l'étudiant
    Route::prefix('etudiant')->group(function () {
        Route::get('/dashboard', [EtudiantDashboardController::class, 'index'])->name('etudiant.dashboard');
        Route::get('/devoirs', [EtudiantDashboardController::class, 'showDevoirs'])->name('etudiant.cours');
        Route::get('/CoursDetails/{id}', [EtudiantDashboardController::class, 'show'])->name('etudiant.CoursDetails');
        Route::get('/devoirs', [EtudiantDashboardController::class, 'showDevoirs'])->name('etudiant.devoirs');
        Route::get('/soumettre-devoir/{devoirId}', [EtudiantDashboardController::class, 'showSoumettreDevoir'])->name('etudiant.soumettre-devoir');
        Route::post('/soumettre-devoir/{devoirId}', [EtudiantDashboardController::class, 'soumettreDevoir'])->name('etudiant.soumettre-devoir.store');
        Route::get('/notes', [EtudiantDashboardController::class, 'showNotes'])->name('etudiant.notes');Route::get('/devoirs/{id}/rendre', [EtudiantController::class, 'showRendreDevoirForm'])->name('etudiant.rendreDevoir');
        Route::post('/devoirs/{id}/rendre', [EtudiantDashboardController::class, 'submitRendreDevoir'])->name('etudiant.submitRendreDevoir');
    });



    

});

require __DIR__.'/auth.php';
