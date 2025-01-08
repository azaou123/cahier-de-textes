<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_Cours';

    protected $fillable = [
        'Nom_Cours',
        'Description_Cours',
        'ID_Filiere',
        'ID_Professeur',
    ];

    // Relationships
    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'ID_Filiere');
    }

    public function professeur()
    {
        return $this->belongsTo(User::class, 'ID_Professeur');
    }

    public function seances()
    {
        return $this->hasMany(Seance::class, 'ID_Cours');
    }

   
    public function devoirs()
    {
        return $this->hasMany(Devoir::class, 'ID_Cours'); // Adjust the foreign key if necessary
    }

    public function ressources()
    {
        return $this->hasMany(CourseResource::class, 'ID_Cours');
    }

    public function etudiants()
    {
        return $this->belongsToMany(User::class, 'cours_etudiant', 'ID_Cours', 'ID_Utilisateur');
    }
}
