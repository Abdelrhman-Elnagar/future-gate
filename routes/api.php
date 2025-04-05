<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\FacultyController;

Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class, 'logout']);
Route::post('/register',[AuthController::class, 'register']);


Route::get('/universities', [UniversityController::class, 'index']);
Route::get('/universities/{id}', [UniversityController::class, 'show']);


Route::get('/faculties', [FacultyController::class, 'index']);
Route::get('/faculties/{id}', [FacultyController::class, 'show']);
Route::get('/faculties/filter', [FacultyController::class, 'filter']); // Filter by track or university
