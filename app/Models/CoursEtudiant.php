<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursEtudiant extends Model
{
    use HasFactory;

    
    protected $table = 'cours_etudiant'; // Ensure this matches the pivot table name
    protected $primaryKey = null; // Pivot tables typically don't have a primary key
    public $incrementing = false; // Disable auto-incrementing for pivot tables
    public $timestamps = false; // Disable timestamps if not used in the pivot table

    protected $fillable = [
        'ID_Cours',
        'ID_Utilisateur',
    ];
}