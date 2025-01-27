<?php

use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/course', [CourseController::class, 'create']);
Route::get('/course', [CourseController::class, 'get_all']);

Route::post('/user', [UserController::class, 'create']);
