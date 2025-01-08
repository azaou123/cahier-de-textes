<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseResource extends Model
{
    protected $fillable = ['ID_Cours', 'title', 'description', 'file_path'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
