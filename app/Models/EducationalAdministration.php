<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalAdministration extends Model
{
    /** @use HasFactory<\Database\Factories\EducationalAdministrationFactory> */
    use HasFactory;



    protected $fillable = ['name', 'governorate_id'];

    // Relationship to Governorate
    public function governorate()
    {
        return $this->belongsTo(Governate::class);
    }

    // Relationship to Users (students)
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Relationship to Schools
    public function schools()
    {
        return $this->hasMany(School::class);
    }
}
