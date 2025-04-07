<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // 'role',

        'seat_number',
        // 'user_id',
        'grade',
        'percentage',
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


     public function governorate()
    {
        return $this->belongsTo(Governate::class);
    }

    public function educationalAdministration()
    {
        return $this->belongsTo(EducationalAdministration::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subjects')->withPivot('grade')->withTimestamps();
    }

    // public function student()
    // {
    //     return $this->hasOne(Student::class);
    // }
}
