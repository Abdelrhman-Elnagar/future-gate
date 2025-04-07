<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Governate;
use App\Models\EducationalAdministration;
use App\Models\School;
use App\Models\Specialization;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Import the students from the Excel file
        $students = Excel::toCollection(null, storage_path('app/public/students.xlsx'))[0]->skip(1);

        foreach ($students as $studentData) {
            // try {
                $studentData = $studentData->toArray(); // مهم عشان تقدر تستخدم keys

                // Create the user (student)
                $user = User::create([
                    'name' => $studentData['الاسم'],
                    'email' => $studentData['البريد الإلكتروني'],
                    'password' => Hash::make('student123'),
                    'seat_number' => $studentData['رقم الجلوس'],
                    'grade' => $studentData['الدرجة'],
                    'phone_number' => $studentData['رقم الهاتف'],
                    'national_id' => $studentData['الرقم القومى'],
                    'gender' => $studentData['الجنس'],
                    'date_of_birth' => $studentData['تاريخ الميلاد'],
                    'address' => $studentData['عنوان السكن'],
                    'governorate_id' => $this->getGovernorateId($studentData['المحافظة']),
                    'educational_administration_id' => $this->getEducationalAdministrationId($studentData['الإدارة التعليمية']),
                    'school_id' => $this->getSchoolId($studentData['المدرسة']),
                    'specialization_id' => $this->getSpecializationId($studentData['التخصص']),
                ]);

                // Assign subjects after the user is created
                $this->assignSubjects($user, $studentData);
            // } catch (\Throwable $e) {
            //     // Log the error if something goes wrong
            //     Log::error("❌ Failed to import student: " . json_encode($studentData) . " | Error: " . $e->getMessage());
            // }
        }
    }

    private function getGovernorateId($name)
    {
        return Governate::where('name', $name)->first()?->id;
    }

    private function getEducationalAdministrationId($name)
    {
        return EducationalAdministration::where('name', $name)->first()?->id;
    }

    private function getSchoolId($name)
    {
        return School::where('name', $name)->first()?->id;
    }

    private function getSpecializationId($name)
    {
        return Specialization::where('name', $name)->first()?->id;
    }

    private function getSubjectId($name)
    {
        return Subject::where('name', $name)->first()?->id;
    }

    private function assignSubjects($user, $studentData)
    {
        $subjects = [];

        $commonSubjects = ['اللغة العربية', 'اللغة الإنجليزية', 'اللغة الثانية'];
        foreach ($commonSubjects as $subject) {
            if (!empty($studentData[$subject])) {
                $subjects[] = $this->getSubjectId($subject);
            }
        }

        $spec = $studentData['التخصص'];

        if ($spec === 'علمى رياضة') {
            foreach (['الفيزياء', 'الكيمياء', 'الرياضيات البحتة', 'الرياضيات التطبيقية'] as $subject) {
                if (!empty($studentData[$subject])) {
                    $subjects[] = $this->getSubjectId($subject);
                }
            }
        } elseif ($spec === 'علمى علوم') {
            foreach (['الفيزياء', 'الكيمياء', 'الأحياء', 'الجيولوجيا'] as $subject) {
                if (!empty($studentData[$subject])) {
                    $subjects[] = $this->getSubjectId($subject);
                }
            }
        } elseif ($spec === 'أدبى') {
            foreach (['التاريخ', 'الجغرافيا', 'الفلسفة', 'علم النفس'] as $subject) {
                if (!empty($studentData[$subject])) {
                    $subjects[] = $this->getSubjectId($subject);
                }
            }
        }

        // Remove empty subjects and assign them to the user
        $subjects = array_filter($subjects);
        $user->subjects()->syncWithoutDetaching($subjects);
    }
}
