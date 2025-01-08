<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_Notification';

    protected $fillable = [
        'ID_Utilisateur',
        'Message',
        'Date_Notification',
        'Statut',
    ];

    // Relationships
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'ID_Utilisateur');
    }
}
