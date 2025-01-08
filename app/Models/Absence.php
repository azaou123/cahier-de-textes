<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_Absence';

    protected $fillable = [
        'ID_Utilisateur',
        'ID_Seance',
        'Justificatif',
        'Statut',
    ];

    // Relationships
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'ID_Utilisateur');
    }

    public function seance()
    {
        return $this->belongsTo(Seance::class, 'ID_Seance');
    }
}
