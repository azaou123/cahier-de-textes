<?php


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $primaryKey = 'ID_Utilisateur';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'Role',
        'Date_inscription',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'Date_inscription' => 'datetime',
    ];

    // Relationships
    public function filieresResponsables()
    {
        return $this->hasMany(Filiere::class, 'Responsable_Filiere');
    }

    public function coursEnseignes()
    {
        return $this->hasMany(Cours::class, 'ID_Professeur');
    }

    public function rendusDevoir()
    {
        return $this->hasMany(RenduDevoir::class, 'ID_Utilisateur');
    }

    public function absences()
    {
        return $this->hasMany(Absence::class, 'ID_Utilisateur');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'ID_Utilisateur');
    }

    // Additional Methods
    public function isProfessor()
    {
        return $this->Role === 'professeur';
    }

    public function isStudent()
    {
        return $this->Role === 'etudiant';
    }

    public function isAdmin()
    {
        return $this->Role === 'admin';
    }

    public function getFullName()
    {
        return $this->Prenom . ' ' . $this->Nom;
    }

    public function getRoleName()
    {
        switch ($this->Role) {
            case 'professeur':
                return 'Professeur';
            case 'etudiant':
                return 'Étudiant';
            case 'admin':
                return 'Administrateur';
            default:
                return 'Inconnu';
        }
    }

    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'ID_Filiere');
    }

    // Relation avec la table cours (many-to-many via cours_etudiant)
    public function cours()
    {
        return $this->belongsToMany(Cours::class, 'cours_etudiant', 'ID_Utilisateur', 'ID_Cours');
    }
}