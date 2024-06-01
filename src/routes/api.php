<?php

declare(strict_types=1);

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:jwt')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
});

Route::group(['prefix' => 'user'], function () {
    Route::post('/create', [UserController::class, 'create']);
});
