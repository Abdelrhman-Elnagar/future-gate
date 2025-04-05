<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'seat_number',
        'user_id',
        'grade',
        'governorate_id',
        'educational_administration_id',
        'school_id',
        'specialization_id',
        'phone_number',
        'national_id',
        'gender',
        'date_of_birth',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
