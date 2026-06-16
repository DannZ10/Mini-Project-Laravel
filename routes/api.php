<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseCategoryController;
use App\Http\Controllers\Api\CourseController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/categories', [CourseCategoryController::class, 'index']);
Route::get('/categories/{id}', [CourseCategoryController::class, 'show']);

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/stats', [CourseController::class, 'stats']);
Route::get('/courses/{id}', [CourseController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/categories', [CourseCategoryController::class, 'store']);
    Route::put('/categories/{id}', [CourseCategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CourseCategoryController::class, 'destroy']);

    Route::post('/courses', [CourseController::class, 'store']);
    Route::put('/courses/{id}', [CourseController::class, 'update']);
    Route::delete('/courses/{id}', [CourseController::class, 'destroy']);
});

?>
