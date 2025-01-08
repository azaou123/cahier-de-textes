<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_Filiere';

    protected $fillable = [
        'Nom_Filiere',
        'Description',
        'Responsable_Filiere',
    ];

    // Relationships
    public function responsable()
    {
        return $this->belongsTo(User::class, 'Responsable_Filiere');
    }

    public function etudiants()
    {
        return $this->hasMany(User::class, 'ID_Filiere');
    }

    // Relation avec la table cours
    public function cours()
    {
        return $this->hasMany(Cours::class, 'ID_Filiere');
    }
}
