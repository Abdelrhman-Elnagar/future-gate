<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UniversitySeeder::class);
        $this->call(GovernateSeeder::class);
        $this->call(EducationalAdministrationSeeder::class);
        $this->call(SchoolSeeder::class);
        $this->call(SpecializationSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(FacultySeeder::class);
    }
}
