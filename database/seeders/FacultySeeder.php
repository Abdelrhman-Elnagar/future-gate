<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faculty;
use App\Models\FacultyGrade;
use App\Models\University;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Faculties data
        $faculties = [
            [
                'name' => 'طب القاهرة',
                'university' => 'Cairo University',
                'description' => 'Faculty of Medicine at Cairo University, one of the top medical schools in Egypt.',
                'duration' => 6,
                'requirements' => 'بطاقة هوية, شهادة الثانوية العامة',
                'ranking' => 1,
                'address' => 'Kasr Al Ainy, Cairo',
                'website' => 'https://med.cu.edu.eg',
                'logo' => 'logos/cairo_medicine.png',
                'grades' => [
                    ['study_track' => 'علمي علوم', 'minimum_grade' => 387.0],
                ]
            ],
            [
                'name' => 'هندسة القاهرة',
                'university' => 'Cairo University',
                'description' => 'Faculty of Engineering at Cairo University, offering top engineering programs.',
                'duration' => 5,
                'requirements' => 'بطاقة هوية, شهادة الثانوية العامة',
                'ranking' => 2,
                'address' => 'Giza, Cairo',
                'website' => 'https://eng.cu.edu.eg',
                'logo' => 'logos/cairo_engineering.png',
                'grades' => [
                    ['study_track' => 'علمي رياضة', 'minimum_grade' => 376.5],
                ]
            ],
            [
                'name' => 'حاسبات و ذكاء اصطناعي القاهرة',
                'university' => 'Cairo University',
                'description' => 'Faculty of Computer Science and Artificial Intelligence.',
                'duration' => 4,
                'requirements' => 'بطاقة هوية, شهادة الثانوية العامة',
                'ranking' => 3,
                'address' => 'Giza, Cairo',
                'website' => 'https://csai.cu.edu.eg',
                'logo' => 'logos/cairo_computer.png',
                'grades' => [
                    ['study_track' => 'علمي علوم', 'minimum_grade' => 368.5],
                    ['study_track' => 'علمي رياضة', 'minimum_grade' => 358.5],
                ]
            ],
            [
                'name' => 'طب عين شمس',
                'university' => 'Ain Shams University',
                'description' => 'Faculty of Medicine at Ain Shams University.',
                'duration' => 6,
                'requirements' => 'بطاقة هوية, شهادة الثانوية العامة',
                'ranking' => 4,
                'address' => 'Abbasia, Cairo',
                'website' => 'https://med.asu.edu.eg',
                'logo' => 'logos/ainshams_medicine.png',
                'grades' => [
                    ['study_track' => 'علمي علوم', 'minimum_grade' => 385.0],
                ]
            ],
            [
                'name' => 'هندسة عين شمس',
                'university' => 'Ain Shams University',
                'description' => 'Faculty of Engineering at Ain Shams University.',
                'duration' => 5,
                'requirements' => 'بطاقة هوية, شهادة الثانوية العامة',
                'ranking' => 5,
                'address' => 'Abbasia, Cairo',
                'website' => 'https://eng.asu.edu.eg',
                'logo' => 'logos/ainshams_engineering.png',
                'grades' => [
                    ['study_track' => 'علمي رياضة', 'minimum_grade' => 373.5],
                ]
            ],
            [
                'name' => 'طب الإسكندرية',
                'university' => 'Alexandria University',
                'description' => 'Faculty of Medicine at Alexandria University.',
                'duration' => 6,
                'requirements' => 'بطاقة هوية, شهادة الثانوية العامة',
                'ranking' => 6,
                'address' => 'Alexandria',
                'website' => 'https://med.alexu.edu.eg',
                'logo' => 'logos/alex_medicine.png',
                'grades' => [
                    ['study_track' => 'علمي علوم', 'minimum_grade' => 388.0],
                ]
            ],
        ];

        foreach ($faculties as $facultyData) {
            // Find university
            $university = University::where('name', $facultyData['university'])->first();

            if (!$university) {
                continue; // Skip if university is not found
            }

            // Create faculty
            $faculty = Faculty::create([
                'name' => $facultyData['name'],
                'university_id' => $university->id,
                'description' => $facultyData['description'],
                'duration' => $facultyData['duration'],
                'requirements' => $facultyData['requirements'],
                'ranking' => $facultyData['ranking'],
                'address' => $facultyData['address'],
                'website' => $facultyData['website'],
                'logo' => $facultyData['logo'],
            ]);

            // Add grades
            foreach ($facultyData['grades'] as $grade) {
                FacultyGrade::create([
                    'faculty_id' => $faculty->id,
                    'study_track' => $grade['study_track'],
                    'minimum_grade' => $grade['minimum_grade'],
                ]);
            }
        }
    }
}
