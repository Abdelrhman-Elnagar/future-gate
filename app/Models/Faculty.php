<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'university_id',
        'description',
        'duration',
        'requirements',
        'location',
        'ranking',
        'address',
        'website',
        'logo',
        'pic',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function grades()
    {
        return $this->hasMany(FacultyGrade::class);
    }
}
