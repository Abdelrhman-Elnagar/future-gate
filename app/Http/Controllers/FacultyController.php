<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFacultyRequest;
use App\Http\Requests\UpdateFacultyRequest;

class FacultyController extends Controller

{
    // Get all faculties
    public function index()
    {
        return response()->json(Faculty::with('university')->get());
    }

    // Get a single faculty by ID
    public function show($id)
    {
        $faculty = Faculty::with('university')->find($id);
        if (!$faculty) {
            return response()->json(['message' => 'Faculty not found'], 404);
        }
        return response()->json($faculty);
    }

    // Filter faculties by track or university
    public function filter(Request $request)
    {
        $query = Faculty::query();

        if ($request->has('track')) {
            $query->where('track', $request->track);
        }

        if ($request->has('university_id')) {
            $query->where('university_id', $request->university_id);
        }

        return response()->json($query->with('university')->get());
    }
}
