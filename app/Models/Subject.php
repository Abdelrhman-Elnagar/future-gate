<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory;

    protected $fillable = ['name', 'track'];

    public function scopeByTrack($query, $track)
    {
        return $query->whereIn('track', $track);
    }

    // Many-to-many relationship to users (students) via student_subjects pivot table
    public function users()
    {
        return $this->belongsToMany(User::class, 'student_subjects')->withPivot('grade')->withTimestamps();
    }
}
