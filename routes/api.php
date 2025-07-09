<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/welcome', fn() => dd('welcome'));
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);

        Route::apiResource('products', ProductController::class);
        // Route::prefix('products')->group(function () {
        //     Route::get('/', [ProductController::class, 'index']);
        //     Route::post('/', [ProductController::class, 'store']);
        //     Route::get('{product}', [ProductController::class, 'show']);
        //     Route::put('{product}', [ProductController::class, 'update']);
        //     Route::delete('{product}', [ProductController::class, 'destroy']);
        // });
    });
});
