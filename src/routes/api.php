<?php

declare(strict_types=1);

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'user'], function () {
    Route::post('/create', [UserController::class, 'create']);
    Route::post('/activate', [UserController::class, 'activate']);
});
