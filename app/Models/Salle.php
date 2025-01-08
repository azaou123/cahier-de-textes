<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_Salle';

    protected $fillable = [
        'Nom_Salle',
        'Capacite',
        'Localisation',
    ];

    // Relationships
    public function seances()
    {
        return $this->hasMany(Seance::class, 'ID_Salle');
    }
}
