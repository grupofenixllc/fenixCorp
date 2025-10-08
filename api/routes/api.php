<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; // Usamos el controlador
use App\Models\Product;
use App\Models\Provider;

// Rutas públicas (login)
Route::post('/login', [AuthController::class, 'login'])->name('login'); // <-- AQUÍ ESTÁ LA CORRECCIÓN

// Rutas protegidas (requieren un token válido)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/products', function () {
        return Product::all();
    });

    Route::get('/providers', function () {
        return Provider::all();
    });
});