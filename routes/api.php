<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// API Auth
Route::post('/register', [AuthController::class, 'registerApi'])->name('register.api');
Route::post('/login', [AuthController::class, 'loginApi'])->name('login.api');

// API yang butuh login (session)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'profileApi'])->name('profile.api');
    Route::post('/logout', [AuthController::class, 'logoutApi'])->name('logout.api');
});
