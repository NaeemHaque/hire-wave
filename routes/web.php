<?php

use App\Http\Controllers\CareerController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobController::class, 'index']);
Route::get('/search', SearchController::class);
Route::get('/tags/{tag:name}', TagController::class);

Route::middleware('auth')->group(function () {
    Route::get('/jobs', [JobController::class, 'create']);
    Route::post('/jobs', [JobController::class, 'store']);
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit']);
    Route::post('/jobs/{job}/update', [JobController::class, 'update']);
    Route::delete('/jobs/{job}', [JobController::class, 'destroy']);
});

Route::get('/jobs/{job}', [JobController::class, 'show']);

Route::middleware('auth')->prefix('/dashboard')->group(function () {
    Route::get('/', [EmployerController::class, 'dashboard']);
    Route::get('/profile', [EmployerController::class, 'profile']);
    Route::post('/profile/update', [EmployerController::class, 'updateProfile']);
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create']);
    Route::post('/login', [SessionController::class, 'store']);
});

Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('/employers', [EmployerController::class, 'index']);
Route::get('/careers', [CareerController::class, 'index']);
