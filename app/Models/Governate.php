<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governate extends Model
{
    /** @use HasFactory<\Database\Factories\GovernateFactory> */
    use HasFactory;

     protected $fillable = ['name'];

    // Define relationship to users (students)
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function educationalAdministrations()
    {
        return $this->hasMany(EducationalAdministration::class);
    }
}
