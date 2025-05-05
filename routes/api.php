<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\StudentController;

Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class, 'logout']);


Route::get('/universities', [UniversityController::class, 'index']);
Route::get('/universities/{id}', [UniversityController::class, 'show']);


Route::get('/faculties', [FacultyController::class, 'index']);
Route::get('/faculties/{id}', [FacultyController::class, 'show']);

Route::middleware('auth:sanctum')->get('/student', [StudentController::class, 'getStudentData']);
Route::get('/students/by-seat-number/{seat_number}', [StudentController::class, 'getStudentWithFaculties']);
Route::get('/students/nomination-paper/{seat_number}', [StudentController::class, 'getStudentNominationPaper']);
