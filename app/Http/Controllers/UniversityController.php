<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Http\Requests\StoreUniversityRequest;
use App\Http\Requests\UpdateUniversityRequest;

class UniversityController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    {
            return response()->json(University::all());
    }
}

/**
 * Display the specified resource.
 */
public function show($id)
{
    $university = University::find($id);
    if (!$university) {
        return response()->json(['message' => 'University not found'], 404);
    }
    return response()->json($university, 200);
}

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(StoreUniversityRequest $request)
    // {
    //     //
    // }



    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(University $university)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(UpdateUniversityRequest $request, University $university)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(University $university)
    // {
    //     //
    // }
}
