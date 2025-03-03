<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\Governate;
use App\Models\EducationalAdministration;
use App\Models\School;
use App\Models\Specialization;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Create a user (Student)
        $user = User::create([
            'name' => 'Omar Mahmoud Ali',
            'email' => 'omar.mahmoud@example.com',
            'password' => bcrypt('student123'), // Secure password
            'role' => 'student',
        ]);

        // Fetch required related data (randomized for realism)
        $governate = Governate::inRandomOrder()->first();
        $administration = EducationalAdministration::where('governate_id', $governate->id)->inRandomOrder()->first();
        $school = School::where('educational_administration_id', $administration->id)->inRandomOrder()->first();
        $specialization = Specialization::where('name', 'Scientific Science')->first(); // علمى علوم

        // Create a student linked to the user
        Student::create([
            'seat_number' => rand(100000, 199999), // Realistic seat number
            'user_id' => $user->id,
            'grade' => rand(300, 410), // Randomized for realism (Out of 410)
            'governate_id' => $governate->id,
            'educational_administration_id' => $administration->id,
            'school_id' => $school->id,
            'specialization_id' => $specialization->id,
            'phone_number' => '010' . rand(10000000, 99999999), // Realistic Egyptian phone number
            'national_id' => rand(20000000000000, 20009999999999), // Random 14-digit ID
            'date_of_birth' => '2007-09-15', // Typical final-year student birth year
            'address' => '25 Tahrir Street, ' . $governate->name,
        ]);
    }
}

