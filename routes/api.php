<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\StudentController;

Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class, 'logout']);
// Route::post('/register',[AuthController::class, 'register']);


Route::get('/universities', [UniversityController::class, 'index']);
Route::get('/universities/{id}', [UniversityController::class, 'show']);


Route::get('/faculties', [FacultyController::class, 'index']);
Route::get('/faculties/{id}', [FacultyController::class, 'show']);
// Route::get('/faculties/filter', [FacultyController::class, 'filter']); // Filter by track or university

// Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/{id}', [StudentController::class, 'show']);
// Route::get('/students/filter', [StudentController::class, 'filter']); // Filter by track
Route::get('/students/by-seat-number/{seat_number}', [StudentController::class, 'getStudentWithFaculties']);
Route::get('/students/nomination-paper/{seat_number}', [StudentController::class, 'getStudentNominationPaper']);
