<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\VideojuegoController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::middleware('auth')->group(function () {
    Route::resource('videojuegos', VideojuegoController::class);
    Route::post('videojuegos/{videojuego}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
});
require __DIR__ . '/auth.php';
