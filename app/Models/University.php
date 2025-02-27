<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    /** @use HasFactory<\Database\Factories\UniversityFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'website',
        'logo',
        'description',
        'established_year',
        'email',
        'phone',
        'address',
        'ranking',
    ];

    // Define relationship with faculties
    public function faculties()
    {
        // return $this->hasMany(Faculty::class);
    }
}
