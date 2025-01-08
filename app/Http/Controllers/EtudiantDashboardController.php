<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Devoir;
use App\Models\RenduDevoir;
use App\Models\Cours;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EtudiantDashboardController extends Controller
{
    // ====================================================
    // Tableau de Bord de l'Étudiant
    // ====================================================
    public function index()
    {
        // Récupérer les cours auxquels l'étudiant est inscrit
        $cours = Auth::user()->cours; // Assurez-vous que la relation est définie dans le modèle User
        return view('etudiant.dashboard', compact('cours'));
    }

    // ====================================================
    // Voir les Devoirs
    // ====================================================
    public function showDevoirs()
    {
        // Récupérer les devoirs des cours auxquels l'étudiant est inscrit
        $devoirs = Devoir::whereHas('cours', function ($query) {
            $query->whereHas('etudiants', function ($q) {
                $q->where('users.ID_Utilisateur', Auth::id()); // Spécifiez la table 'users'
            });
        })->get();

        return view('etudiant.homework', compact('devoirs'));
    }
    public function show($id)
    {
        $cours = Cours::with('professeur', 'filiere')->findOrFail($id);
        // Récupérer les ressources du cours
        $ressources = $cours->ressources()->orderBy('created_at', 'asc')->get();

        // Récupérer les devoirs du cours
        $devoirs = $cours->devoirs()->orderBy('created_at', 'asc')->get();
        $existingSubmission = RenduDevoir::withTrashed()
        ->where('ID_Devoir', $id)
        ->where('ID_Utilisateur', Auth::id())
        ->first();

        return view('etudiant.coursDetails', compact('cours', 'ressources', 'devoirs', 'existingSubmission'));
    }


    // ====================================================
    // Soumettre un Devoir
    // ====================================================
    public function showRendreDevoirForm($id)
{
    // Récupérer le devoir
    $devoir = Devoir::findOrFail($id);

    return view('etudiant.rendreDevoir', compact('devoir'));
}


public function submitRendreDevoir(Request $request, $id)
{
    // Validate input data
    $request->validate([
        'fichier' => 'required|file|mimes:pdf,doc,docx,zip|max:2048', // File size limit: 2MB
        'commentaire' => 'nullable|string|max:500',
    ]);

    // Retrieve the "Devoir" record
    $devoir = Devoir::findOrFail($id);

    // Save the uploaded file
    $filePath = $request->file('fichier')->store('rendus_devoirs');

    // Create a new "Rendu Devoir" record
    RenduDevoir::create([
        'ID_Devoir' => $devoir->ID_Devoir,
        'ID_Utilisateur' => Auth::id(),
        'Fichier_Rendu' => $filePath,
        'Date_Rendu' => now(),
        'Commentaire' => $request->commentaire,
    ]);

    // Redirect to course details page with success message
    return redirect()->route('etudiant.CoursDetails', $devoir->ID_Cours)
                     ->with('success', 'Devoir soumis avec succès.');
}


    // ====================================================
    // Voir les Notes et Commentaires
    // ====================================================
    public function showNotes()
    {
        // Récupérer les soumissions de l'étudiant avec les notes et commentaires
        $soumissions = RenduDevoir::where('ID_Utilisateur', Auth::id())
            ->with('devoir')
            ->get();

        return view('etudiant.notes', compact('soumissions'));
    }
}