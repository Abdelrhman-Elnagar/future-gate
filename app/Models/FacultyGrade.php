<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyGrade extends Model
{
    /** @use HasFactory<\Database\Factories\FacultyGradeFactory> */
    use HasFactory;

    protected $fillable = ['faculty_id', 'study_track', 'minimum_grade', 'percentage'];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
}
