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

Route::get('/video/{id}', [VideosController::class, 'show'])->name('videos.show');
Route::get('/videos', [VideosController::class, 'index'])->name('videos.index');

// Rutes que requerixen els permisos
Route::middleware(['auth', 'can:manage-videos'])->group(function () {
    Route::get('/videos/manage/{id}/edit', [VideosManageController::class, 'edit'])->name('videos.manage.edit');
    Route::get('/videos/manage/create', [VideosManageController::class, 'create'])->name('videos.manage.create');
    Route::put('/videos/manage/{id}', [VideosManageController::class, 'update'])->name('videos.manage.update');
    Route::post('/videos/manage', [VideosManageController::class, 'store'])->name('videos.manage.store');
    Route::delete('/videos/manage/{id}', [VideosManageController::class, 'destroy'])->name('videos.manage.destroy');
    Route::get('/videos/manage', [VideosManageController::class, 'index'])->name('videos.manage.index');
});
