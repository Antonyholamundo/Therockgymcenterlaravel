<?php

use App\Http\Controllers\CategoriApiController;
use App\Http\Controllers\DetalleIngresoApiController;
use App\Http\Controllers\IngresoApiController;
use App\Http\Controllers\MembresiaApiController;
use App\Http\Controllers\MembresiaUsuarioApiController;
use App\Http\Controllers\ProductoApiController;
use App\Http\Controllers\UsuarioApiController;
use App\Http\Controllers\VentaApiController;
use Illuminate\Routing\Route;

Route::apiResource("ventas", VentaApiController::class);

Route::apiResource("usuarios", UsuarioApiController::class);

Route::apiResource("ingresos", IngresoApiController::class);

Route::apiResource("categorias", CategoriApiController::class);

Route::apiResource("productos", ProductoApiController::class);

Route::apiResource("detallesIngresos", DetalleIngresoApiController::class);

Route::apiResource("membresia", MembresiaApiController::class);

Route::apiResource("membresiaUsuario", MembresiaUsuarioApiController::class);

