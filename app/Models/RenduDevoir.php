<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RenduDevoir extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'ID_Rendu';

    protected $fillable = ['ID_Devoir', 'ID_Utilisateur', 'Fichier_Rendu', 'Date_Rendu', 'Note', 'Commentaire'];

    // Relationships
    public function devoir()
    {
        return $this->belongsTo(Devoir::class, 'ID_Devoir');
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'ID_Utilisateur');
    }
}