<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SuperMercadoController;
use App\Http\Controllers\Api\CiudadController;

#Rutas del supermercado
Route::get('/supermercado/all', [SuperMercadoController::class, 'index']);
Route::post('/supermercado', [SuperMercadoController::class, 'store']);
Route::get('/supermercado/{id}', [SuperMercadoController::class, 'show']);
Route::delete('/supermercado/{id}', [SuperMercadoController::class, 'destroy']);
Route::put('/supermercado/{id}', [SuperMercadoController::class, 'update']);

#Rutas de la ciudad
Route::post('/ciudad', [CiudadController::class, 'store']);
Route::get('/ciudades', [CiudadController::class, 'index']);
