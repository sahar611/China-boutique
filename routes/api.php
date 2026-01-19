<?php
use App\Http\Controllers\Api\AuthController;

Route::prefix('auth')->group(function () {

    // Signup (create user + send otp)
    Route::post('register', [AuthController::class, 'register']);

    // Login (send otp to existing user)
    Route::post('login', [AuthController::class, 'login']);

    // Verify OTP (for both register & login)
    Route::post('verify-otp', [AuthController::class, 'verifyOtp']);

 
});
