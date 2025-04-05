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
            ['name' => 'الفيزياء', 'track' => 'علمى_رياضة'],
            ['name' => 'الكيمياء', 'track' => 'علمى_علوم'],
            ['name' => 'الأحياء', 'track' => 'علمى_علوم'],
            ['name' => 'الجيولوجيا', 'track' => 'علمى_علوم'],
            ['name' => 'الرياضيات البحتة', 'track' => 'علمى_رياضة'],
            ['name' => 'الرياضيات التطبيقية', 'track' => 'علمى_رياضة'],
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
