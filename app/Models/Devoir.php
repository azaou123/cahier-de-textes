<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devoir extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_Devoir';

    protected $fillable = [
        'Titre_Devoir',
        'Description_Devoir',
        'Date_Limite',
        'ID_Cours',
        'file_path', // Ajoutez ce champ
    ];

    // Relationships
    public function cours()
    {
        return $this->belongsTo(Cours::class, 'ID_Cours');
    }

    public function rendusDevoir()
    {
        return $this->hasMany(RenduDevoir::class, 'ID_Devoir');
    }
}
