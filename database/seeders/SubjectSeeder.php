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
            ['name' => 'اللغة العربية', 'track' => 'عام'],
            ['name' => 'اللغة الإنجليزية', 'track' => 'عام'],
            ['name' => 'اللغة الأجنبية الثانية', 'track' => 'عام'],

            ['name' => 'الفيزياء', 'track' => 'علمى رياضة'],
            ['name' => 'الكيمياء', 'track' => 'علمى رياضة'],
            ['name' => 'الرياضيات البحتة', 'track' => 'علمى رياضة'],
            ['name' => 'الرياضيات التطبيقية', 'track' => 'علمى رياضة'],
            
            ['name' => 'الفيزياء', 'track' => 'علمى علوم'],
            ['name' => 'الكيمياء', 'track' => 'علمى علوم'],
            ['name' => 'الأحياء', 'track' => 'علمى علوم'],
            ['name' => 'الجيولوجيا', 'track' => 'علمى علوم'],

            ['name' => 'التاريخ', 'track' => 'أدبى'],
            ['name' => 'الجغرافيا', 'track' => 'أدبى'],
            ['name' => 'الفلسفة', 'track' => 'أدبى'],
            ['name' => 'علم النفس', 'track' => 'أدبى'],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
