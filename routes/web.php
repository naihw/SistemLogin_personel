<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'registerWeb'])->name('register.post');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'loginWeb'])->name('login.post');

// Logout
Route::post('/logout', [AuthController::class, 'webLogout'])->name('auth.webLogout');

// Dashboard (protected)
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');

// Profile (protected)
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
});

//profile edit
Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
