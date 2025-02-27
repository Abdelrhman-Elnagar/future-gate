<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversityController;

Route::get('/universities', [UniversityController::class, 'index']);
Route::get('/universities/{id}', [UniversityController::class, 'show']);


