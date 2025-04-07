<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    /** @use HasFactory<\Database\Factories\SchoolFactory> */
    use HasFactory;

    protected $fillable = ['name', 'educational_administration_id'];

    // Relationship to EducationalAdministration
    public function educationalAdministration()
    {
        return $this->belongsTo(EducationalAdministration::class);
    }

    // Relationship to Users (students)
    public function users()
    {
        return $this->hasMany(User::class);
    }
}

