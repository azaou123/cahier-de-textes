<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Cours;
use App\Models\Seance;
use App\Models\Devoir;
use App\Models\RenduDevoir;
use App\Models\CourseResource;
use App\Models\Filiere;
use App\Models\User;
use App\Models\Salle;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ProfesseurDashboardController extends Controller
{
    // ====================================================
    // Tableau de Bord du Professeur
    // ====================================================
    public function index()
    {
        // Get the authenticated professor's ID
        $professeurId = Auth::id();

        // Fetch statistics for the professeur dashboard
        $totalCours = Cours::where('ID_Professeur', $professeurId)->count();
        $totalSeances = $seances = Seance::whereHas('cours', function ($query) {
            $query->where('ID_Professeur', Auth::id());
        })->count();

        // Fetch the list of courses for the professor
        $cours = Cours::where('ID_Professeur', $professeurId)->get();

        // Return the view with the statistics and courses
        return view('professeur.dashboard', compact('totalCours', 'totalSeances', 'cours'));
    }

    // ====================================================
    // Gestion des Cours
    // ====================================================
    public function showCourses()
    {
        // Récupérer les cours du professeur connecté
        $cours = Cours::where('ID_Professeur', Auth::id())->get();
        return view('professeur.courses', compact('cours'));
    }

    public function createCourse()
    {
        // Récupérer les filières pour le formulaire de création
        $filieres = Filiere::all();
        return view('professeur.courses.create', compact('filieres'));
    }

    public function storeCourse(Request $request)
    {
        // Validation des données
        $request->validate([
            'Nom_Cours' => 'required|string|max:255',
            'Description_Cours' => 'nullable|string',
            'ID_Filiere' => 'required|exists:filieres,ID_Filiere',
        ]);

        // Créer un nouveau cours
        Cours::create([
            'Nom_Cours' => $request->Nom_Cours,
            'Description_Cours' => $request->Description_Cours,
            'ID_Filiere' => $request->ID_Filiere,
            'ID_Professeur' => Auth::id(),
        ]);

        return redirect()->route('professeur.courses')->with('success', 'Cours créé avec succès.');
    }

    public function editCourse($id)
    {
        // Récupérer le cours à modifier
        $cours = Cours::findOrFail($id);
        $filieres = Filiere::all();
        return view('professeur.courses.edit', compact('cours', 'filieres'));
    }

    public function updateCourse(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'Nom_Cours' => 'required|string|max:255',
            'Description_Cours' => 'nullable|string',
            'ID_Filiere' => 'required|exists:filieres,ID_Filiere',
        ]);

        // Mettre à jour le cours
        $cours = Cours::findOrFail($id);
        $cours->update([
            'Nom_Cours' => $request->Nom_Cours,
            'Description_Cours' => $request->Description_Cours,
            'ID_Filiere' => $request->ID_Filiere,
        ]);

        return redirect()->route('professeur.courses')->with('success', 'Cours mis à jour avec succès.');
    }

    public function deleteCourse($id)
    {
        // Supprimer le cours
        $cours = Cours::findOrFail($id);
        $cours->delete();
        return redirect()->route('professeur.courses')->with('success', 'Cours supprimé avec succès.');
    }

    // ====================================================
    // Gestion des Séances
    // ====================================================
    public function showSessions()
    {
        // Récupérer les séances du professeur connecté
        $seances = Seance::whereHas('cours', function ($query) {
            $query->where('ID_Professeur', Auth::id());
        })->get();
        $salles = Salle::all();
        return view('professeur.sessions', compact('seances'), compact('salles'));
    }

    public function createSession()
    {
        // Récupérer les cours du professeur pour le formulaire de création
        $cours = Cours::where('ID_Professeur', Auth::id())->get();
        $salles = Salle::all();
        return view('professeur.sessionsCreate', compact('cours'), compact('salles'));
    }

    public function storeSession(Request $request)
    {
        // Debug the request data

        // Validation des données
        $request->validate([
            'Date_Seance' => 'required|date',
            'Heure_Debut' => 'required|date_format:H:i',
            'Heure_Fin' => 'required|date_format:H:i|after:Heure_Debut',
            'ID_Cours' => 'required|exists:cours,ID_Cours',
            'ID_Salle' => 'required|exists:salles,ID_Salle',
            'description' => 'required|string', // Validation pour la description
        ]);

        // Créer une nouvelle séance
        Seance::create([
            'Date_Seance' => $request->Date_Seance,
            'Heure_Debut' => $request->Heure_Debut,
            'Heure_Fin' => $request->Heure_Fin,
            'ID_Cours' => $request->ID_Cours,
            'ID_Salle' => $request->ID_Salle,
            'description' => $request->description, // Enregistrer la description
        ]);

        return redirect()->route('professeur.sessions')->with('success', 'Séance créée avec succès.');
    }

    public function editSession($id)
    {
        // Récupérer la séance à modifier
        $seance = Seance::findOrFail($id);
        $cours = Cours::where('ID_Professeur', Auth::id())->get();
        $salles = Salle::all();
        return view('professeur.sessionsEdit', compact('seance', 'cours', 'salles'));
    }

    public function updateSession(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'Date_Seance' => 'required|date',
            'Heure_Debut' => 'required|date_format:H:i',
            'Heure_Fin' => 'required|date_format:H:i|after:Heure_Debut',
            'ID_Cours' => 'required|exists:cours,ID_Cours',
            'ID_Salle' => 'required|exists:salles,ID_Salle',
            'description' => 'nullable|string', // Validation pour la description
        ]);

        // Mettre à jour la séance
        $seance = Seance::findOrFail($id);
        $seance->update([
            'Date_Seance' => $request->Date_Seance,
            'Heure_Debut' => $request->Heure_Debut,
            'Heure_Fin' => $request->Heure_Fin,
            'ID_Cours' => $request->ID_Cours,
            'ID_Salle' => $request->ID_Salle,
            'description' => $request->description, // Mettre à jour la description
        ]);

        return redirect()->route('professeur.sessions')->with('success', 'Séance mise à jour avec succès.');
    }

    public function deleteSession($id)
    {
        // Supprimer la séance
        $seance = Seance::findOrFail($id);
        $seance->delete();
        return redirect()->route('professeur.sessions')->with('success', 'Séance supprimée avec succès.');
    }

    // ====================================================
    // Gestion des Devoirs
    // ====================================================
    public function showHomework()
    {
        // Récupérer les devoirs du professeur connecté
        $devoirs = Devoir::whereHas('cours', function ($query) {
            $query->where('ID_Professeur', Auth::id());
        })->get();
        return view('professeur.homework', compact('devoirs'));
    }

    public function createHomework()
    {
        // Récupérer les cours du professeur pour le formulaire de création
        $cours = Cours::where('ID_Professeur', Auth::id())->get();
        return view('professeur.homeworkCreate', compact('cours'));
    }

    public function storeHomework(Request $request)
    {
        // Validation des données
        $request->validate([
            'Titre_Devoir' => 'required|string|max:255',
            'Description_Devoir' => 'nullable|string',
            'Date_Limite' => 'required|date',
            'ID_Cours' => 'required|exists:cours,ID_Cours',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:2048', // Validation du fichier
        ]);

        // Enregistrer le fichier si présent
        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); // Récupérer le nom original du fichier
            $file->storeAs('devoirs_files', $fileName, 'public'); // Stocker dans public
        }

        // Créer un nouveau devoir
        Devoir::create([
            'Titre_Devoir' => $request->Titre_Devoir,
            'Description_Devoir' => $request->Description_Devoir,
            'Date_Limite' => $request->Date_Limite,
            'ID_Cours' => $request->ID_Cours,
            'file_path' => $fileName, // Stocker uniquement le nom du fichier
        ]);

        return redirect()->route('professeur.homework')->with('success', 'Devoir créé avec succès.');
    }

    public function editHomework($id)
    {
        // Récupérer le devoir à modifier
        $devoir = Devoir::findOrFail($id);
        $cours = Cours::where('ID_Professeur', Auth::id())->get();
        return view('professeur.homeworkEdit', compact('devoir', 'cours'));
    }

    public function updateHomework(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'Titre_Devoir' => 'required|string|max:255',
            'Description_Devoir' => 'nullable|string',
            'Date_Limite' => 'required|date',
            'ID_Cours' => 'required|exists:cours,ID_Cours',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:2048', // Validation du fichier
        ]);

        // Récupérer le devoir à mettre à jour
        $devoir = Devoir::findOrFail($id);

        // Mettre à jour le fichier si présent
        if ($request->hasFile('file')) {
            // Supprimer l'ancien fichier si nécessaire
            if ($devoir->file_path && Storage::disk('public')->exists('devoirs_files/' . $devoir->file_path)) {
                Storage::disk('public')->delete('devoirs_files/' . $devoir->file_path);
            }

            // Enregistrer le nouveau fichier
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); // Récupérer le nom original du fichier
            $file->storeAs('devoirs_files', $fileName, 'public'); // Stocker dans public
            $devoir->file_path = $fileName; // Mettre à jour le nom du fichier
        }

        // Mettre à jour les autres champs
        $devoir->update([
            'Titre_Devoir' => $request->Titre_Devoir,
            'Description_Devoir' => $request->Description_Devoir,
            'Date_Limite' => $request->Date_Limite,
            'ID_Cours' => $request->ID_Cours,
        ]);

        return redirect()->route('professeur.homework')->with('success', 'Devoir mis à jour avec succès.');
    }

    public function deleteHomework($id)
    {
        // Récupérer le devoir à supprimer
        $devoir = Devoir::findOrFail($id);

        // Supprimer le fichier associé s'il existe
        if ($devoir->file_path && Storage::disk('public')->exists('devoirs_files/' . $devoir->file_path)) {
            Storage::disk('public')->delete('devoirs_files/' . $devoir->file_path);
        }

        // Supprimer le devoir de la base de données
        $devoir->delete();

        return redirect()->route('professeur.homework')->with('success', 'Devoir supprimé avec succès.');
    }

    
    // ====================================================
    // Gestion des RenduDevoir (Soumissions des Étudiants)
    // ====================================================
    public function showSubmissions($devoirId)
    {
        // Récupérer les soumissions pour un devoir spécifique
        $devoir = Devoir::findOrFail($devoirId);
        $submissions = RenduDevoir::where('ID_Devoir', $devoirId)->get();
        return view('professeur.homeworkSubmissions', compact('submissions','devoir'));
    }

    public function gradeSubmission(Request $request, $submissionId)
    {
        // Validation des données
        $request->validate([
            'Note' => 'required|numeric|min:0|max:20',
            'Commentaire' => 'nullable|string',
        ]);

        // Mettre à jour la note et le commentaire
        $submission = RenduDevoir::findOrFail($submissionId);
        $submission->update([
            'Note' => $request->Note,
            'Commentaire' => $request->Commentaire,
        ]);

        return redirect()->back()->with('success', 'Soumission notée avec succès.');
    }


    // ====================================================
    // Gestion des Ressources de Cours
    // ====================================================
    public function showCourseResources($courseId)
    {
        // Récupérer les ressources du cours spécifique
        $course = Cours::findOrFail($courseId);
        $resources = CourseResource::where('ID_Cours', $courseId)->get();
        return view('professeur.courseResources', compact('course', 'resources'));
    }

    public function createCourseResource($courseId)
    {
        // Récupérer le cours pour lequel la ressource est créée
        $course = Cours::findOrFail($courseId);
        return view('professeur.courseResourcesCreate', compact('course'));
    }

    public function storeCourseResource(Request $request, $courseId)
    {
        // Validation des données
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:2048',
        ]);

        // Enregistrer le fichier dans storage/app/public/course_resources
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName(); // Récupérer le nom original du fichier
        $filePath = $file->storeAs('course_resources', $fileName, 'public'); // Stocker dans public

        // Créer une nouvelle ressource
        CourseResource::create([
            'ID_Cours' => $courseId,
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $fileName, // Stocker uniquement le nom du fichier
        ]);

        return redirect()->route('professeur.courseResources', $courseId)->with('success', 'Ressource créée avec succès.');
    }

    public function editCourseResource($resourceId)
    {
        // Récupérer la ressource à modifier
        $resource = CourseResource::findOrFail($resourceId);
        return view('professeur.courseResourcesEdit', compact('resource'));
    }

    public function updateCourseResource(Request $request, $resourceId)
    {
        // Validation des données
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:2048',
        ]);

        // Récupérer la ressource à mettre à jour
        $resource = CourseResource::findOrFail($resourceId);
        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        // Gérer le fichier s'il est fourni
        if ($request->hasFile('file')) {
            // Supprimer l'ancien fichier s'il existe
            if ($resource->file_path) {
                Storage::disk('public')->delete('course_resources/' . $resource->file_path);
            }

            // Enregistrer le nouveau fichier dans storage/app/public/course_resources
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); // Récupérer le nom original du fichier
            $filePath = $file->storeAs('course_resources', $fileName, 'public'); // Stocker dans public

            // Mettre à jour le nom du fichier dans la base de données
            $data['file_path'] = $fileName;
        }

        // Mettre à jour la ressource
        $resource->update($data);

        return redirect()->route('professeur.courseResources', $resource->ID_Cours)->with('success', 'Ressource mise à jour avec succès.');
    }

    public function deleteCourseResource($resourceId)
    {
        // Récupérer la ressource à supprimer
        $resource = CourseResource::findOrFail($resourceId);

        // Supprimer le fichier associé s'il existe
        if ($resource->file_path && Storage::disk('public')->exists('course_resources/' . $resource->file_path)) {
            Storage::disk('public')->delete('course_resources/' . $resource->file_path);
        }

        // Supprimer la ressource de la base de données
        $resource->delete();

        return redirect()->route('professeur.courseResources', $resource->ID_Cours)->with('success', 'Ressource supprimée avec succès.');
    }

    public function showCahierDeTexteForm()
    {
        return view('professeur.cahier-de-texte');
    }

    // Générer le PDF du cahier de texte
    public function generateCahierDeTextePDF(Request $request)
    {
        // Récupérer les dates de début et de fin
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Filtrer les séances dans la période sélectionnée
        $seances = Seance::whereBetween('Date_Seance', [$startDate, $endDate])->get();

        // Filtrer les devoirs dans la période sélectionnée
        $devoirs = Devoir::whereBetween('created_at', [$startDate, $endDate])->get();

        // Filtrer les cours associés aux séances
        $coursIds = $seances->pluck('ID_Cours')->unique();
        $cours = Cours::whereIn('ID_Cours', $coursIds)->get();

        // Générer le PDF
        $pdf = Pdf::loadView('professeur.cahier-de-texte-pdf', compact('seances', 'devoirs', 'cours', 'startDate', 'endDate'));

        // Télécharger le PDF
        return $pdf->download('cahier-de-texte.pdf');
    }
}