<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GameController as AdminGameController;
use App\Http\Controllers\Player\GameController as PlayerGameController;
use App\Http\Controllers\Player\HistoryController;
use App\Http\Controllers\Api\GameSessionController;

Route::get('/', function () {
    return view('welcome');
});

// El Dashboard principal ahora es el CATALOGO de juegos para todos
Route::get('/dashboard', [PlayerGameController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Panel ADMINISTRADOR (Solo admin@plataforma.com)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // CRUD de Usuarios
    Route::resource('users', UserController::class)->names('admin.users');
    
    // CRUD de Juegos
    Route::resource('games', AdminGameController::class)->names('admin.games');
});

// Panel JUGADOR - Accesible para cualquier usuario autenticado (admin o player)
Route::middleware(['auth'])->prefix('player')->group(function () {
    Route::get('games/{game}', [PlayerGameController::class, 'show'])->name('player.games.show');
    Route::get('history', [HistoryController::class, 'index'])->name('player.history.index');

    // Rutas de sesiones de juego (guardado de puntuaciones)
    Route::post('games/{game}/session', [GameSessionController::class, 'start'])->name('game.session.start');
    Route::put('sessions/{session}/update', [GameSessionController::class, 'update'])->name('game.session.update');
});

require __DIR__.'/auth.php';
