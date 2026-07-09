<?php

use App\Http\Controllers\Api\AuthController;

// Route untuk login mendengarkan request POST
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);