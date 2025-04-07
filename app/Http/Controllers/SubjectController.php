<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\User;

class SubjectController extends Controller
{

    public function assignSubjectsToStudent($userId)
    {
        $user = User::find($userId); // Get the student

        // Determine the student's specialization track
        $track = $user->specialization->track; // Assuming 'track' is stored in the specialization table

        // Filter subjects based on the student's specialization track
        $subjects = $this->getSubjectsByTrack($track);

        // Attach subjects to the student
        foreach ($subjects as $subject) {
            $user->subjects()->attach($subject->id, ['grade' => null]); // Assign subject without grade for now
        }

        return response()->json(['message' => 'Subjects assigned successfully!']);
    }

    public function getSubjectsByTrack($track)
    {
        $activeTracks = [];

        switch ($track) {
            case 'أدبى':
                // Get both "عام" and "أدبى" subjects
                $activeTracks = ['عام', 'أدبى'];
                break;
            case 'علمى علوم':
                // Get both "عام" and "علمى علوم" subjects
                $activeTracks = ['عام', 'علمى علوم'];
                break;
            case 'علمى رياضة':
                // Get both "عام" and "علمى رياضة" subjects
                $activeTracks = ['عام', 'علمى رياضة'];
                break;
            default:
                // Handle any default case or invalid track
                break;
        }

        // Return the subjects based on the active tracks
        return Subject::byTrack($activeTracks)->get();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
