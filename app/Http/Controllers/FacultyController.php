<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFacultyRequest;
use App\Http\Requests\UpdateFacultyRequest;

class FacultyController extends Controller

{
    // Fetch all faculties
    public function index()
    {
        $faculties = Faculty::inRandomOrder()->get();
        return response()->json($faculties);
    }

    // Fetch a specific faculty by ID
    public function show($id)
    {
        $faculty = Faculty::find($id);

        if (!$faculty) {
            return response()->json(['message' => 'Faculty not found'], 404);
        }

        return response()->json($faculty);
    }

    // Filter faculties by track or university
    public function filter(Request $request)
    {
        $query = Faculty::query();

        // Normalize input track
        if ($request->has('track')) {
            $track = $request->input('track');
            $normalizedTrack = mb_convert_encoding($track, 'UTF-8', 'auto');  // Ensure UTF-8 encoding

            $query->join('faculty_grades', 'faculties.id', '=', 'faculty_grades.faculty_id')
                ->where('faculty_grades.study_track', 'LIKE', "%$normalizedTrack%");
        }

        // Optionally, filter by university if provided
        if ($request->has('university')) {
            $university = $request->input('university');
            $query->where('faculties.university_id', $university);
        }

        // Get the filtered results
        $faculties = $query->select('faculties.*')->distinct()->get();

        if ($faculties->isEmpty()) {
            return response()->json(['message' => 'Faculty not found'], 404);
        }

        return response()->json($faculties);
    }
}
