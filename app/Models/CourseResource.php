<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseResource extends Model
{
    use HasFactory;
    protected $fillable = ['ID_Cours', 'title', 'description', 'file_path'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
