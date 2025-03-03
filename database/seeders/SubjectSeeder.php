<?php

namespace Database\Seeders;
use App\Models\Subject;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            ['name' => 'Arabic Language', 'track' => 'general'],
            ['name' => 'English Language', 'track' => 'general'],
            ['name' => 'Second Language', 'track' => 'general'],
            ['name' => 'Physics', 'track' => 'scientific_math'],
            ['name' => 'Chemistry', 'track' => 'scientific_science'],
            ['name' => 'Biology', 'track' => 'scientific_science'],
            ['name' => 'Geology', 'track' => 'scientific_science'],
            ['name' => 'Pure Mathematics', 'track' => 'scientific_math'],
            ['name' => 'Applied Mathematics', 'track' => 'scientific_math'],
            ['name' => 'History', 'track' => 'literary'],
            ['name' => 'Geography', 'track' => 'literary'],
            ['name' => 'Philosophy', 'track' => 'literary'],
            ['name' => 'Psychology', 'track' => 'literary'],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
