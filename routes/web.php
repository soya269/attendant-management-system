<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AttendantController;

// 1. Root Route - Redirect to Login or Attendant List
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// 3. Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// 4. Attendant Management Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::resource('attendants', AttendantController::class);
});