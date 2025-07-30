<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StudentClassController;
use App\Http\Controllers\Api\BookingController;
 
Route::prefix('v1')->group(function () {

    // Auth routes
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    // Protected routes (require token auth)
    Route::middleware(['auth:sanctum'])->group(function () {
        // Auth actions
        Route::post('/logout', [AuthController::class, 'logout']);

        // Main API actions
        Route::post('/classes', [StudentClassController::class, 'store']);
        Route::get('/classes', [StudentClassController::class, 'index']);
        Route::post('/book', [BookingController::class, 'store']);
        Route::get('/bookings', [BookingController::class, 'index']); 
    });
});
