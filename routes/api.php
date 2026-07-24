<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MenuApiController;
use App\Http\Controllers\Api\ReservationApiController;
use App\Http\Controllers\Api\TableApiController;
use Illuminate\Support\Facades\Route;

// Login (publik, tidak perlu token)
Route::post('/login', [AuthController::class, 'login']);

// Publik: lihat meja & menu tanpa perlu login
Route::get('/tables', [TableApiController::class, 'index']);
Route::get('/menus', [MenuApiController::class, 'index']);

// Perlu token (login dulu lewat /api/login untuk dapat token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/reservations', [ReservationApiController::class, 'index']);
    Route::post('/reservations', [ReservationApiController::class, 'store']);
    Route::get('/reservations/{reservation}', [ReservationApiController::class, 'show']);
});