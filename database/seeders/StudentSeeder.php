<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Governate;
use App\Models\EducationalAdministration;
use App\Models\School;
use App\Models\Specialization;
use App\Models\Subject;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Import the students from the Excel file
        $students = Excel::toCollection(null, storage_path('app/public/students.xlsx'))[0];

        // Get the headers from the first row
        $headers = $students->first()->toArray();

        // Skip the header row and process the remaining rows
        $students = $students->slice(1); // Remove the first row (headers)

        foreach ($students as $index => $studentData) {
            try {
                // Convert numeric-indexed array to associative array using headers
                $studentData = array_combine($headers, $studentData->toArray());

                // Ensure that all required keys exist
                if (!isset($studentData['الاسم']) || !isset($studentData['البريد الإلكتروني'])) {
                    Log::warning("Missing required fields for student at row " . ($index + 2) . ": " . json_encode($studentData));
                    continue; // Skip this student if necessary fields are missing
                }

                // Create the user (student)
                $user = User::create([
                    'name' => $studentData['الاسم'],
                    'email' => $studentData['البريد الإلكتروني'] ?? 'noemail@example.com',
                    'password' => Hash::make('student123'),
                    'seat_number' => $studentData['رقم الجلوس'],
                    'grade' => $studentData['الدرجة'],
                    'phone_number' => $studentData['رقم الهاتف'],
                    'national_id' => $studentData['الرقم القومى'],
                    'gender' => $studentData['الجنس'],
                    'date_of_birth' => $studentData['تاريخ الميلاد'],
                    'address' => $studentData['عنوان السكن'],
                    'percentage' => $studentData['النسبة المئوية'],
                    'governorate_id' => $this->getGovernorateId($studentData['المحافظة']),
                    'educational_administration_id' => $this->getEducationalAdministrationId($studentData['الإدارة التعليمية']),
                    'school_id' => $this->getSchoolId($studentData['المدرسة']),
                    'specialization_id' => $this->getSpecializationId($studentData['التخصص']),
                ]);

                // Assign subjects after the user is created
                $this->assignSubjects($user, $studentData);
            } catch (\Throwable $e) {
                // Log the error if something goes wrong
                Log::error("❌ Failed to import student at row " . ($index + 2) . ": " . json_encode($studentData) . " | Error: " . $e->getMessage());
            }
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
        } elseif ($spec === 'علمي علوم') {
            foreach (['الفيزياء', 'الكيمياء', 'الأحياء', 'الجيولوجيا'] as $subject) {
                if (!empty($studentData[$subject])) {
                    $subjects[] = $this->getSubjectId($subject);
                }
            }
        } elseif ($spec === 'أدبي') {
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
