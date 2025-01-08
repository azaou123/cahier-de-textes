<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Filiere;
use App\Models\Salle;
use App\Models\Cours;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    // ====================================================
    // Tableau de Bord de l'Admin
    // ====================================================
    public function index()
    {
        // Statistiques pour le tableau de bord
        $totalProfesseurs = User::where('Role', 'professeur')->count();
        $totalFilieres = Filiere::count();
        $totalEtudiants = User::where('Role', 'etudiant')->count();
        $totalCours = Cours::count();

        return view('admin.dashboard', compact('totalProfesseurs', 'totalFilieres', 'totalEtudiants', 'totalCours'));
    }

    // ====================================================
    // Gestion des Professeurs
    // ====================================================
    public function showProfesseurs()
    {
        // Récupérer tous les professeurs
        $professeurs = User::where('Role', 'professeur')->get();
        return view('admin.professeurs', compact('professeurs'));
    }

    public function createProfesseur()
    {
        // Afficher le formulaire de création d'un professeur
        return view('admin.professeurs.create');
    }

    public function storeProfesseur(Request $request)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Créer un nouveau professeur
        User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'Role' => 'professeur',
        ]);

        return redirect()->route('admin.professeurs')->with('success', 'Professeur créé avec succès.');
    }

    public function editProfesseur($id)
    {
        // Récupérer le professeur à modifier
        $professeur = User::findOrFail($id);
        return view('admin.professeurs.edit', compact('professeur'));
    }

    public function updateProfesseur(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        // Mettre à jour le professeur
        $professeur = User::findOrFail($id);
        $professeur->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.professeurs')->with('success', 'Professeur mis à jour avec succès.');
    }

    public function deleteProfesseur($id)
    {
        // Supprimer le professeur
        $professeur = User::findOrFail($id);
        $professeur->delete();
        return redirect()->route('admin.professeurs')->with('success', 'Professeur supprimé avec succès.');
    }

    // ====================================================
    // Gestion des Filieres
    // ====================================================
    public function showFilieres()
    {
        // Récupérer toutes les filières
        $filieres = Filiere::all();
        return view('admin.filieres', compact('filieres'));
    }

    public function createFiliere()
    {
        // Afficher le formulaire de création d'une filière
        $professeurs = User::where('Role', 'professeur')->get();
        return view('admin.filieresCreate', compact('professeurs'));
    }

    public function storeFiliere(Request $request)
    {
        // Validation des données
        $request->validate([
            'Nom_Filiere' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Responsable_Filiere' => 'required|exists:users,ID_Utilisateur', // Vérifie que le responsable existe
        ]);

        // Créer une nouvelle filière
        Filiere::create([
            'Nom_Filiere' => $request->Nom_Filiere,
            'Description' => $request->Description,
            'Responsable_Filiere' => $request->Responsable_Filiere,
        ]);

        return redirect()->route('admin.filieres')->with('success', 'Filière créée avec succès.');
    }

    public function editFiliere($id)
    {
        // Récupérer la filière à modifier
        $filiere = Filiere::findOrFail($id);
        $professeurs = User::where('Role', 'professeur')->get();
        return view('admin.filieresEdit', compact('filiere', 'professeurs'));
    }

    public function updateFiliere(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'Nom_Filiere' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Responsable_Filiere' => 'required|exists:users,ID_Utilisateur', // Vérifie que le responsable existe
        ]);

        // Mettre à jour la filière
        $filiere = Filiere::findOrFail($id);
        $filiere->update([
            'Nom_Filiere' => $request->Nom_Filiere,
            'Description' => $request->Description,
            'Responsable_Filiere' => $request->Responsable_Filiere,
        ]);

        return redirect()->route('admin.filieres')->with('success', 'Filière mise à jour avec succès.');
    }

    public function deleteFiliere($id)
    {
        // Supprimer la filière
        $filiere = Filiere::findOrFail($id);
        $filiere->delete();
        return redirect()->route('admin.filieres')->with('success', 'Filière supprimée avec succès.');
    }

    // ====================================================
    // Gestion des Étudiants
    // ====================================================
    public function showEtudiants()
    {
        // Récupérer tous les étudiants
        $etudiants = User::where('Role', 'etudiant')->get();
        return view('admin.etudiants', compact('etudiants'));
    }

    public function createEtudiant()
    {
        // Afficher le formulaire de création d'un étudiant
        return view('admin.etudiants.create');
    }

    public function storeEtudiant(Request $request)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Créer un nouvel étudiant
        User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'Role' => 'etudiant',
        ]);

        return redirect()->route('admin.etudiants')->with('success', 'Étudiant créé avec succès.');
    }

    public function editEtudiant($id)
    {
        // Récupérer l'étudiant à modifier
        $etudiant = User::findOrFail($id);
        $filieres = Filiere::all();
        return view('admin.etudiantsEdit', compact('etudiant', 'filieres'));
    }

    public function updateEtudiant(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'filiere' => 'required|exists:filieres,ID_Filiere',
        ]);

        $etudiant = User::findOrFail($id);
        $etudiant->nom = $request->nom;
        $etudiant->prenom = $request->prenom;
        $etudiant->email = $request->email;
        $etudiant->ID_Filiere = $request->filiere;
        $etudiant->save();

        return redirect()->route('admin.etudiants')->with('success', 'Étudiant mis à jour avec succès.');
    }

    public function deleteEtudiant($id)
    {
        // Supprimer l'étudiant
        $etudiant = User::findOrFail($id);
        $etudiant->delete();
        return redirect()->route('admin.etudiants')->with('success', 'Étudiant supprimé avec succès.');
    }

    public function showAffecterFiliereForm()
    {
        $etudiants = User::where('Role', 'etudiant')->get();
        $filieres = Filiere::all();

        return view('admin.affecter-filiere', compact('etudiants', 'filieres'));
    }

    // Traiter l'affectation des étudiants
    public function affecterFiliere(Request $request)
    {
        $request->validate([
            'ID_Utilisateur' => 'required|exists:users,ID_Utilisateur',
            'ID_Filiere' => 'required|exists:filieres,ID_Filiere',
        ]);

        // Mettre à jour la filière de l'étudiant
        $etudiant = User::findOrFail($request->ID_Utilisateur);
        $etudiant->ID_Filiere = $request->ID_Filiere;
        $etudiant->save();

        return redirect()->back()->with('success', 'Étudiant affecté à la filière avec succès.');
    }

    // ====================================================
    // Gestion des Cours
    // ====================================================
    public function showCours()
    {
        // Récupérer tous les cours avec leurs filières et professeurs
        $cours = Cours::with(['filiere', 'professeur'])->get();
        return view('admin.courses', compact('cours'));
    }

    public function createCours()
    {
        // Récupérer toutes les filières et les professeurs
        $filieres = Filiere::all();
        $professeurs = User::where('Role', 'professeur')->get();
        return view('admin.coursCreate', compact('filieres', 'professeurs'));
    }

    public function storeCours(Request $request)
    {
        // Validation des données
        $request->validate([
            'Nom_Cours' => 'required|string|max:255',
            'Description_Cours' => 'nullable|string',
            'ID_Filiere' => 'required|exists:filieres,ID_Filiere',
            'ID_Professeur' => 'required|exists:users,ID_Utilisateur',
        ]);

        // Créer un nouveau cours
        Cours::create([
            'Nom_Cours' => $request->Nom_Cours,
            'Description_Cours' => $request->Description_Cours,
            'ID_Filiere' => $request->ID_Filiere,
            'ID_Professeur' => $request->ID_Professeur,
        ]);

        return redirect()->route('admin.courses')->with('success', 'Cours créé avec succès.');
    }

    public function editCours($id)
    {
        // Récupérer le cours à modifier
        $cours = Cours::findOrFail($id);

        // Récupérer toutes les filières et les professeurs
        $filieres = Filiere::all();
        $professeurs = User::where('Role', 'professeur')->get();

        return view('admin.coursEdit', compact('cours', 'filieres', 'professeurs'));
    }

    public function updateCours(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'Nom_Cours' => 'required|string|max:255',
            'Description_Cours' => 'nullable|string',
            'ID_Filiere' => 'required|exists:filieres,ID_Filiere',
            'ID_Professeur' => 'required|exists:users,ID_Utilisateur',
        ]);

        // Mettre à jour le cours
        $cours = Cours::findOrFail($id);
        $cours->update([
            'Nom_Cours' => $request->Nom_Cours,
            'Description_Cours' => $request->Description_Cours,
            'ID_Filiere' => $request->ID_Filiere,
            'ID_Professeur' => $request->ID_Professeur,
        ]);

        return redirect()->route('admin.courses')->with('success', 'Cours mis à jour avec succès.');
    }

    public function deleteCours($id)
    {
        // Supprimer le cours
        $cours = Cours::findOrFail($id);
        $cours->delete();
        return redirect()->route('admin.courses')->with('success', 'Cours supprimé avec succès.');
    }


    // ====================================================
    // Gestion des Salles
    // ====================================================
    public function showSalles()
    {
        // Récupérer toutes les salles
        $salles = Salle::all();
        return view('admin.salles', compact('salles'));
    }

    public function createSalle()
    {
        // Afficher le formulaire de création d'une salle
        return view('admin.sallesCreate');
    }

    public function storeSalle(Request $request)
    {
        // Validation des données
        $request->validate([
            'Nom_Salle' => 'required|string|max:100',
            'Capacite' => 'required|integer|min:1',
            'Localisation' => 'required|string|max:255', // Ajoutez cette ligne
            'Description' => 'nullable|string',
        ]);

        // Créer une nouvelle salle
        Salle::create([
            'Nom_Salle' => $request->Nom_Salle,
            'Capacite' => $request->Capacite,
            'Localisation' => $request->Localisation, // Ajoutez cette ligne
            'Description' => $request->Description,
        ]);

        return redirect()->route('admin.salles')->with('success', 'Salle créée avec succès.');
    }

    public function editSalle($id)
    {
        // Récupérer la salle à modifier
        $salle = Salle::findOrFail($id);
        return view('admin.sallesEdit', compact('salle'));
    }

    public function updateSalle(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'Nom_Salle' => 'required|string|max:100',
            'Capacite' => 'required|integer|min:1',
            'Localisation' => 'nullable|string',
        ]);

        // Mettre à jour la salle
        $salle = Salle::findOrFail($id);
        $salle->update([
            'Nom_Salle' => $request->Nom_Salle,
            'Capacite' => $request->Capacite,
            'Localisation' => $request->Localisation,
        ]);

        return redirect()->route('admin.salles')->with('success', 'Salle mise à jour avec succès.');
    }

    public function deleteSalle($id)
    {
        // Supprimer la salle
        $salle = Salle::findOrFail($id);
        $salle->delete();
        return redirect()->route('admin.salles')->with('success', 'Salle supprimée avec succès.');
    }
}