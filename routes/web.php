<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\VideojuegoController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('dashboard', [VideojuegoController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::middleware('auth')->group(function () {
    Route::resource('videojuegos', VideojuegoController::class);
    Route::post('videojuegos/{videojuego}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('/videojuegos/{id}', [VideojuegoController::class, 'destroy'])->name('videojuegos.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/videojuegos', [VideojuegoController::class, 'index'])->name('videojuegos.index');
    Route::get('/videojuegos/create', [VideojuegoController::class, 'create'])->name('videojuegos.create');
    Route::post('/videojuegos', [VideojuegoController::class, 'store'])->name('videojuegos.store');
});
require __DIR__ . '/auth.php';
