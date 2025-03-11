<?php

use App\Http\Controllers\VideosController;
use App\Http\Controllers\VideosManageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// Rutes per a la visualització de vídeos
Route::get('/video/{id}', [VideosController::class, 'show'])->name('videos.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/videos/manage', [VideosController::class, 'manage'])->name('videos.manage');
});

//Route::get('/videos', [VideosManageController::class, 'index'])->name('videos.index');
//
//// Rutes de gestió de vídeos amb protecció de permisos
Route::middleware(['auth', 'can:manage-videos'])->group(function () {
    Route::get('/videos/manage', [VideosManageController::class, 'index'])->name('videos.manage.index');
});
