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

Route::middleware('auth')->prefix('/jobs')->group(function () {
    Route::get('/', [JobController::class, 'create']);
    Route::post('/', [JobController::class, 'store']);
    Route::get('/{job}', [JobController::class, 'show']);
    Route::get('/{job}/edit', [JobController::class, 'edit']);
    Route::put('/{job}', [JobController::class, 'update']);
    Route::delete('/{job}', [JobController::class, 'destroy']);
});

Route::middleware('auth')->prefix('/dashboard')->group(function () {
    Route::get('/', [EmployerController::class, 'dashboard']);
    Route::get('/profile', [EmployerController::class, 'profile']);
    Route::put('/profile', [EmployerController::class, 'updateProfile']);
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
