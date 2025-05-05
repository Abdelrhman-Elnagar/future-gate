<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Specialization;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\FacultyGrade;

class StudentController extends Controller
{
    /**
     * Display a listing of students.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            // Retrieve students with their related data (governorate, educational administration, school, specialization)
            $students = User::with(['governate', 'educationalAdministration', 'school', 'specialization'])->get();
                // ->paginate(10); // Paginate with 10 students per page

            return response()->json([
                'success' => true,
                'data' => $students,
                'message' => 'Students retrieved successfully',
            ], 200);
        } catch (\Exception $e) {
            Log::error("Error in StudentController@index: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve students',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display a specific student by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            // Retrieve the student by ID with related data
            $student = User::with(['governate', 'educationalAdministration', 'school', 'specialization'])
                ->find($id);

            if (!$student) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $student,
                'message' => 'Student retrieved successfully',
            ], 200);
        } catch (\Exception $e) {
            Log::error("Error in StudentController@show: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve student',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Filter students by track (specialization).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'track' => 'required|string|exists:specializations,name', // Ensure the track exists in the specializations table
            ]);

            // Retrieve students filtered by track (specialization)
            $track = $request->query('track');
            $students = User::whereHas('specialization', function ($query) use ($track) {
                $query->where('name', $track);
            })
                ->with(['governorate', 'educationalAdministration', 'school', 'specialization'])
                ->paginate(10); // Paginate with 10 students per page

            if ($students->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No students found for the specified track',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $students,
                'message' => 'Students filtered by track successfully',
            ], 200);
        } catch (\Exception $e) {
            Log::error("Error in StudentController@filter: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to filter students',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function getStudentData()
    {
        $student = User::with(['governate', 'educationalAdministration', 'school', 'specialization', 'subjects'])
            ->find(Auth::id());

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json($student);
    }

    public function getStudentWithFaculties($seat_number)
    {
        try {
            if (!is_numeric($seat_number) || $seat_number < 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid seat number',
                ], 400);
            }

            // Load student with relationships, including subjects
            $student = User::with([
                'governate',
                'educationalAdministration',
                'school',
                'specialization',
                'subjects' // Load the subjects relationship
            ])->where('seat_number', $seat_number)->first();

            if (!$student) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student not found',
                ], 404);
            }

            // Get the student's specialization (study track)
            $studyTrack = $student->specialization ? $student->specialization->name : null;
            if (!$studyTrack) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student specialization not found',
                ], 400);
            }

            // Get the top 10 faculties matching the student's grade and specialization
            $faculties = FacultyGrade::with(['faculty.university'])
                ->where('study_track', $studyTrack) // Match specialization
                ->where('minimum_grade', '<=', $student->grade) // Match grade
                ->orderBy('minimum_grade', 'desc') // Highest minimum_grade first
                ->take(10)
                ->get()
                ->pluck('faculty') // Extract faculty objects
                ->filter() // Remove null values (if any)
                ->values(); // Re-index the collection

            if ($faculties->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'student' => $student->toArray(), // Convert student object to array
                        'subjects' => $student->subjects->toArray(), // Convert subjects collection to array
                        'faculties' => []
                    ],
                    'message' => 'No faculties found matching the student\'s grade and specialization',
                ], 200);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'student' => $student->toArray(), // Convert student object to array
                    'subjects' => $student->subjects->toArray(), // Convert subjects collection to array
                    'faculties' => $faculties
                ],
                'message' => 'Student information and faculties retrieved successfully',
            ], 200);
        } catch (\Exception $e) {
            Log::error("Error in StudentController@getStudentWithFaculties: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve student and faculties',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getStudentNominationPaper($seat_number)
    {
        try {
            if (!is_numeric($seat_number) || $seat_number < 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid seat number',
                ], 400);
            }

            // Load student with relationships, including subjects
            $student = User::with([
                'governate',
                'educationalAdministration',
                'school',
                'specialization',
                'subjects' // Load the subjects relationship
            ])->where('seat_number', $seat_number)->first();

            if (!$student) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student not found',
                ], 404);
            }

            // Get the student's specialization (study track)
            $studyTrack = $student->specialization ? $student->specialization->name : null;
            if (!$studyTrack) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student specialization not found',
                ], 400);
            }

            // Get the first faculty matching the student's grade and specialization
            $faculty = FacultyGrade::with(['faculty.university'])
                ->where('study_track', $studyTrack) // Match specialization
                ->where('minimum_grade', '<=', $student->grade) // Match grade
                ->orderBy('minimum_grade', 'desc') // Highest minimum_grade first
                ->first(); // Get the first record

            if (!$faculty) {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'student' => $student->toArray(), // Convert student object to array
                        'subjects' => $student->subjects->toArray(), // Convert subjects collection to array
                        'faculty' => null // No faculty found
                    ],
                    'message' => 'No faculty found matching the student\'s grade and specialization',
                ], 200);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'student' => $student->toArray(), // Convert student object to array
                    'subjects' => $student->subjects->toArray(), // Convert subjects collection to array
                    'faculty' => $faculty->faculty // Extract the faculty object
                ],
                'message' => 'Student information and nomination faculty retrieved successfully',
            ], 200);
        } catch (\Exception $e) {
            Log::error("Error in StudentController@getStudentNominationPaper: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve student and nomination faculty',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
