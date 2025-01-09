<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_Seance';

    protected $fillable = [
        'Date_Seance',
        'Heure_Debut',
        'Heure_Fin',
        'ID_Cours',
        'ID_Salle',
        'description'
    ];

    // Relationships
    public function cours()
    {
        return $this->belongsTo(Cours::class, 'ID_Cours');
    }

    public function salle()
    {
        return $this->belongsTo(Salle::class, 'ID_Salle');
    }

    public function absences()
    {
        return $this->hasMany(Absence::class, 'ID_Seance');
    }
}
