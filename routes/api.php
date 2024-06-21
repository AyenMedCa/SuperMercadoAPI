<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SuperMercadoController;
use App\Http\Controllers\Api\CiudadController;

Route::get('/supermercado', [SuperMercadoController::class, 'getListaSuperMercado']);
