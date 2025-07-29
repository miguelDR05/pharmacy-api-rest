<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LabController;
use App\Http\Controllers\Api\ProductTypeController;
use App\Http\Controllers\Api\ProductPresentationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/welcome', fn() => dd('welcome'));
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user', [AuthController::class, 'user']);
        Route::post('logout', [AuthController::class, 'logout']);

        Route::apiResource('category', CategoryController::class);
        Route::apiResource('product', ProductController::class);

        Route::apiResource('lab', LabController::class);
        Route::apiResource('product-type', ProductTypeController::class); // Usamos 'product-type' para la URL
        Route::apiResource('product-presentation', ProductPresentationController::class); // Usamos 'product-presentation' para la URL

        // Rutas para combos (filtradas por 'active' y formato label/value)
        Route::get('categories-combo', [CategoryController::class, 'combo']);
        Route::get('labs-combo', [LabController::class, 'combo']);
        Route::get('product-types-combo', [ProductTypeController::class, 'combo']);
        Route::get('product-presentations-combo', [ProductPresentationController::class, 'combo']);
    });
});
