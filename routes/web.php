<?php

use App\Http\Controllers\VideosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth', // Només els usuaris autenticats poden veure aquestes rutes
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Ruta per gestionar vídeos amb política d'autorització i rols específics
    Route::get('/videos/manage', [VideosController::class, 'manage'])
        ->name('videos.manage')
        ->middleware('role:video_manager|super_admin'); // Protegeix amb rols
});

Route::get('/videos/{id}', [VideosController::class, 'show'])->name('videos.vista');
