<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController; 

// create admin
Route::post('create-admin', [AdminController::class, 'createAdmin']);

// Admin login
Route::post('admin/login', [AuthController::class, 'adminLogin']);


    // Admin-only routes
   Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
    Route::post('create-user', [AdminController::class, 'createUser']);
    Route::get('list-users', [AdminController::class, 'listUsers']);
});




// Mobile app user login
Route::post('login', [AuthController::class, 'userLogin']);

// Mobile app user-protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'userLogout']);
});
