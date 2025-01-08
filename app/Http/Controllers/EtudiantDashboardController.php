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
    $ressources = $cours->ressources()->orderBy('created_at', 'asc')->get();
    $devoirs = $cours->devoirs()->orderBy('created_at', 'asc')->get();

    \Log::info('Devoirs: ' . json_encode($devoirs));
    \Log::info('User ID: ' . Auth::id());

    $existingSubmission = null;
    if ($devoirs->isNotEmpty()) {
        $devoirId = $devoirs->first()->ID_Devoir; // Use ID_Devoir instead of id
        $existingSubmission = RenduDevoir::withTrashed()
            ->where('ID_Devoir', $devoirId)
            ->where('ID_Utilisateur', Auth::id())
            ->first();

        \Log::info('Query executed: ' . RenduDevoir::withTrashed()
            ->where('ID_Devoir', $devoirId)
            ->where('ID_Utilisateur', Auth::id())
            ->toSql());
    }

    \Log::info('Existing Submission: ' . json_encode($existingSubmission));

    return view('etudiant.coursDetails', compact('cours', 'ressources', 'devoirs', 'existingSubmission'));
}

public function deleteSubmission($id)
{
    $submission = RenduDevoir::findOrFail($id);

    // Optional: Check if the authenticated user owns the submission
    if ($submission->ID_Utilisateur !== Auth::id()) {
        return redirect()->back()->with('error', 'You are not authorized to delete this submission.');
    }

    // Delete the file from storage if it exists
    if (Storage::exists($submission->Fichier_Rendu)) {
        Storage::delete($submission->Fichier_Rendu);
    }

    // Delete the submission from the database
    $submission->delete();

    return redirect()->back()->with('success', 'Submission deleted successfully.');
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