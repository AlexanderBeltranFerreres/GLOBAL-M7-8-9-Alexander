<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\VideosManageController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SeriesManageController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsersManageController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
});

/**
 *  Rutes públiques per a vídeos
 */
Route::get('/videos', [VideosController::class, 'index'])->name('videos.index');
Route::get('/videos/{id}', [VideosController::class, 'show'])->name('videos.show');

/**
 *  Rutes de gestió de vídeos
 */
Route::middleware(['auth', 'can:manage-videos'])
    ->prefix('manage/videos')
    ->name('videos.manage.')
    ->group(function () {
        Route::get('/', [VideosManageController::class, 'index'])->name('index');
        Route::get('/create', [VideosManageController::class, 'create'])->name('create');
        Route::post('/', [VideosManageController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [VideosManageController::class, 'edit'])->name('edit');
        Route::put('/{id}', [VideosManageController::class, 'update'])->name('update');
        Route::delete('/{id}', [VideosManageController::class, 'destroy'])->name('destroy');
    });

/**
 *  Rutes públiques per a sèries
 */
Route::middleware(['auth'])->group(function () {
    Route::get('/series', [SeriesController::class, 'index'])->name('series.index');
    Route::get('/series/{id}', [SeriesController::class, 'show'])->name('series.show');
    Route::get('/create', [SeriesManageController::class, 'create'])->name('create');
    Route::post('/', [SeriesManageController::class, 'store'])->name('store');
});

/**
 *  Rutes de gestió de sèries
 */
Route::middleware(['auth', 'can:manage-series'])
    ->prefix('manage/series')
    ->name('series.manage.')
    ->group(function () {
        Route::get('/', [SeriesManageController::class, 'index'])->name('index');
        Route::get('/create', [SeriesManageController::class, 'create'])->name('create');
        Route::post('/', [SeriesManageController::class, 'store'])->name('store');
        Route::get('/{serie}/edit', [SeriesManageController::class, 'edit'])->name('edit');
        Route::put('/{serie}', [SeriesManageController::class, 'update'])->name('update');
        Route::delete('/{serie}', [SeriesManageController::class, 'destroy'])->name('destroy');
    });

/**
 *  Rutes públiques per a usuaris
 */
Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UsersController::class, 'show'])->name('users.show');
});

/**
 * Rutes de gestió d'usuaris
 */
Route::middleware(['auth', 'can:manage-users'])
    ->prefix('manage/users')
    ->name('users.manage.')
    ->group(function () {
        Route::get('/', [UsersManageController::class, 'index'])->name('index');
        Route::get('/create', [UsersManageController::class, 'create'])->name('create');
        Route::post('/', [UsersManageController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UsersManageController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UsersManageController::class, 'update'])->name('update');
        Route::delete('/{user}', [UsersManageController::class, 'destroy'])->name('destroy');
    });
