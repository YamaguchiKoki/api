<?php

declare(strict_types=1);

use App\Http\Controllers\Actions\GetProfile;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:jwt')->group(function () {
    Route::get('/me', [UserController::class, 'show']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/profile', GetProfile::class);
    Route::post('/user/update', [UserController::class, 'update']);
    Route::group(['prefix' => 'playlist'], function () {
      Route::get('/index', [PlaylistController::class, 'index'])->name('playlist.index');
      Route::get('/show', [PlaylistController::class, 'show'])->name('playlist.show');
      Route::post('/store', [PlaylistController::class, 'store'])->name('playlist.store');
    });
});
Route::group(['prefix' => 'user'], function () {
    Route::post('/create', [UserController::class, 'create']);
});
