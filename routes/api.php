<?php

use App\Http\Controllers\AccesoController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResponsableController;

// ── Rutas públicas ─────────────────────────────────────────
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login',    [AuthController::class, 'login']);
});

// ── Rutas protegidas ───────────────────────────────────────
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::prefix('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me',      [AuthController::class, 'me']);
    });

    // Módulos
    Route::apiResource('responsables', ResponsableController::class);
    Route::apiResource('areas',        AreaController::class);
    Route::apiResource('accesos',      AccesoController::class)->except(['update']);
    Route::patch('accesos/{acceso}/check-out', [AccesoController::class, 'checkOut'])
         ->name('accesos.check-out');
});