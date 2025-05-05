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

                // Convert Excel date (days since 1900-01-01) to YYYY-MM-DD format
                $excelDate = $studentData['تاريخ الميلاد'];
                $dateOfBirth = $this->convertExcelDateToDateTime($excelDate);
                if (!$dateOfBirth) {
                    Log::warning("Invalid date of birth for student at row " . ($index + 2) . ": " . json_encode($studentData));
                    continue;
                }

                // Get foreign key IDs
                $governateId = $this->getGovernorateId($studentData['المحافظة']);
                $educationalAdministrationId = $this->getEducationalAdministrationId($studentData['الإدارة التعليمية']);
                $schoolId = $this->getSchoolId($studentData['المدرسة']);
                $specializationId = $this->getSpecializationId($studentData['التخصص']);

                // Check if any foreign key is missing
                if (!$governateId) {
                    Log::warning("Governorate not found for student at row " . ($index + 2) . ": " . json_encode($studentData));
                    continue;
                }
                if (!$educationalAdministrationId) {
                    Log::warning("Educational Administration not found for student at row " . ($index + 2) . ": " . json_encode($studentData));
                    continue;
                }
                if (!$schoolId) {
                    Log::warning("School not found for student at row " . ($index + 2) . ": " . json_encode($studentData));
                    continue;
                }
                if (!$specializationId) {
                    Log::warning("Specialization not found for student at row " . ($index + 2) . ": " . json_encode($studentData));
                    continue;
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
                    'date_of_birth' => $dateOfBirth,
                    'address' => $studentData['عنوان السكن'],
                    'percentage' => $studentData['النسبة المئوية'],
                    'governate_id' => $governateId,
                    'educational_administration_id' => $educationalAdministrationId,
                    'school_id' => $schoolId,
                    'specialization_id' => $specializationId,
                ]);

                // Assign subjects after the user is created
                $this->assignSubjects($user, $studentData);
            } catch (\Throwable $e) {
                // Log the error if something goes wrong
                Log::error("❌ Failed to import student at row " . ($index + 2) . ": " . json_encode($studentData) . " | Error: " . $e->getMessage());
            }
        }
    }

    /**
     * Convert Excel date (days since 1900-01-01) to YYYY-MM-DD format
     *
     * @param int|string $excelDate
     * @return string|null
     */
    private function convertExcelDateToDateTime($excelDate)
    {
        if (is_numeric($excelDate) && $excelDate > 0) {
            // Excel dates are days since 1900-01-01, but Excel incorrectly treats 1900 as a leap year
            // So we need to adjust for this bug: subtract 1 day if the date is after 1900-02-28
            $days = (int) $excelDate;
            if ($days > 59) { // After 1900-02-28
                $days -= 1; // Adjust for Excel's 1900 leap year bug
            }

            // Create a DateTime object starting from 1900-01-01
            $date = new \DateTime('1900-01-01');
            // Add the number of days
            $date->modify("+$days days");
            // Return the date in YYYY-MM-DD format
            return $date->format('Y-m-d');
        }

        // If the date is invalid, return null
        return null;
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
        $subjectsWithPivotData = [];

        $commonSubjects = ['اللغة العربية', 'اللغة الإنجليزية', 'اللغة الثانية'];
        foreach ($commonSubjects as $subjectName) {
            $subjectId = $this->getSubjectId($subjectName);
            if ($subjectId && isset($studentData[$subjectName])) {
                $grade = $studentData[$subjectName]; // Assuming the grade is in the same column
                $subjectsWithPivotData[$subjectId] = ['grade' => $grade];
            }
        }

        $spec = $studentData['التخصص'];

        if ($spec === 'علمى رياضة') {
            foreach (['الفيزياء', 'الكيمياء', 'الرياضيات البحتة', 'الرياضيات التطبيقية'] as $subjectName) {
                $subjectId = $this->getSubjectId($subjectName);
                if ($subjectId && isset($studentData[$subjectName])) {
                    $grade = $studentData[$subjectName];
                    $subjectsWithPivotData[$subjectId] = ['grade' => $grade];
                }
            }
        } elseif ($spec === 'علمي علوم') {
            foreach (['الفيزياء', 'الكيمياء', 'الأحياء', 'الجيولوجيا'] as $subjectName) {
                $subjectId = $this->getSubjectId($subjectName);
                if ($subjectId && isset($studentData[$subjectName])) {
                    $grade = $studentData[$subjectName];
                    $subjectsWithPivotData[$subjectId] = ['grade' => $grade];
                }
            }
        } elseif ($spec === 'أدبي') {
            foreach (['التاريخ', 'الجغرافيا', 'الفلسفة', 'علم النفس'] as $subjectName) {
                $subjectId = $this->getSubjectId($subjectName);
                if ($subjectId && isset($studentData[$subjectName])) {
                    $grade = $studentData[$subjectName];
                    $subjectsWithPivotData[$subjectId] = ['grade' => $grade];
                }
            }
        }

        // Attach the subjects with the grade data to the user
        $user->subjects()->sync($subjectsWithPivotData);
    }
}
