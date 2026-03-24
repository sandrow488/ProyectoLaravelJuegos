<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GameSessionController;

/**
 * Rutas de la API (Usamos la sesión web para el juego dentro del iframe)
 */
Route::middleware('web', 'auth')->group(function () {
    Route::post('/games/{game}/session', [GameSessionController::class, 'start']);
    Route::put('/sessions/{session}/update', [GameSessionController::class, 'update']);
});
