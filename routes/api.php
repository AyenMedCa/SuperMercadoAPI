<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SuperMercadoController;
use App\Http\Controllers\Api\CiudadController;
use App\Http\Controllers\auth\AuthController;

# Rutas del supermercado con middleware 'auth:api'
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/supermercado/all', [SuperMercadoController::class, 'index']);
    Route::post('/supermercado', [SuperMercadoController::class, 'store']);
    Route::get('/supermercado/{id}', [SuperMercadoController::class, 'show']);
    Route::delete('/supermercado/{id}', [SuperMercadoController::class, 'destroy']);
    Route::put('/supermercado/{id}', [SuperMercadoController::class, 'update']);
});

# Rutas de la ciudad con middleware 'auth:api'
Route::group(['middleware' => 'auth:api'], function() {
    Route::post('/ciudad', [CiudadController::class, 'store']);
    Route::get('/ciudad/all', [CiudadController::class, 'index']);
    Route::get('/ciudad/{id}', [CiudadController::class, 'show']);
});

# Rutas para el auth
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router){
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});
