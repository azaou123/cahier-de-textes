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
        // Récupérer le cours avec le professeur et la filière
        $cours = Cours::with('professeur', 'filiere')->findOrFail($id);

        // Récupérer les ressources du cours triées par date de création
        $ressources = $cours->ressources()->orderBy('created_at', 'asc')->get();

        // Récupérer les devoirs du cours triés par date de création
        $devoirs = $cours->devoirs()->orderBy('created_at', 'asc')->get();

        // Vérifier s'il existe une soumission pour le premier devoir (non supprimée)
        $existingSubmission = null;
        if ($devoirs->isNotEmpty()) {
            $devoirId = $devoirs->first()->ID_Devoir; // Utiliser ID_Devoir au lieu de id

            // Récupérer la soumission non supprimée
            $existingSubmission = RenduDevoir::where('ID_Devoir', $devoirId)
                ->where('ID_Utilisateur', Auth::id())
                ->first();
        }

        // Retourner la vue avec les données
        return view('etudiant.coursDetails', compact('cours', 'ressources', 'devoirs', 'existingSubmission'));
    }

    public function deleteSubmission($id)
    {
        // Récupérer la soumission à supprimer
        $submission = RenduDevoir::findOrFail($id);
    
        // Vérifier que l'utilisateur authentifié est propriétaire de la soumission
        if ($submission->ID_Utilisateur !== Auth::id()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à supprimer cette soumission.');
        }
    
        // Supprimer le fichier associé s'il existe
        if ($submission->Fichier_Rendu && Storage::disk('public')->exists('rendus_devoirs/' . $submission->Fichier_Rendu)) {
            Storage::disk('public')->delete('rendus_devoirs/' . $submission->Fichier_Rendu);
        }
    
        // Supprimer la soumission de la base de données
        $submission->delete();
    
        return redirect()->back()->with('success', 'Soumission supprimée avec succès.');
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
    // Validation des données
    $request->validate([
        'fichier' => 'required|file|mimes:pdf,doc,docx,zip|max:2048', // Taille maximale : 2 Mo
        'commentaire' => 'nullable|string|max:500',
    ]);

    // Récupérer le devoir
    $devoir = Devoir::findOrFail($id);

    // Enregistrer le fichier dans storage/app/public/rendus_devoirs
    $file = $request->file('fichier');
    $fileName = $file->getClientOriginalName(); // Récupérer le nom original du fichier
    $file->storeAs('rendus_devoirs', $fileName, 'public'); // Stocker dans public

    // Créer un nouveau rendu de devoir
    RenduDevoir::create([
        'ID_Devoir' => $devoir->ID_Devoir,
        'ID_Utilisateur' => Auth::id(),
        'Fichier_Rendu' => $fileName, // Stocker uniquement le nom du fichier
        'Date_Rendu' => now(),
        'Commentaire' => $request->commentaire,
    ]);

    // Rediriger vers la page des détails du cours avec un message de succès
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