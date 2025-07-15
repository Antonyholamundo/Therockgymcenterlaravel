<?php
use App\Http\Controllers\DetallesIngresosController;
use App\Http\Controllers\IngresosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\MembresiasController;
use App\Http\Controllers\MembresiasUsuariosController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\ReportesController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('index');
})->name('index');
// Rutas principales por controlador
Route::resource('usuarios', UsuariosController::class);
Route::resource('roles', RolesController::class);
Route::resource('permisos', PermisosController::class);
Route::resource('membresias', MembresiasController::class);
Route::resource('membresias_usuarios', MembresiasUsuariosController::class);
Route::resource('categorias', CategoriasController::class);
Route::resource('productos', ProductosController::class);
Route::resource('ingresos', IngresosController::class);
Route::resource('detalles_ingresos', DetallesIngresosController::class);
Route::resource('ventas', VentasController::class);

// Rutas de reportes
Route::get('/reportes', [ReportesController::class, 'index'])->name('reportes.index');
Route::get('/reportes/ventas', [ReportesController::class, 'ventas'])->name('reportes.ventas');
Route::get('/reportes/ingresos', [ReportesController::class, 'ingresos'])->name('reportes.ingresos');
Route::get('/reportes/inventario', [ReportesController::class, 'inventario'])->name('reportes.inventario');
Route::get('/reportes/usuarios', [ReportesController::class, 'usuarios'])->name('reportes.usuarios');
Route::get('/reportes/membresias', [ReportesController::class, 'membresias'])->name('reportes.membresias');
Route::get('/reportes/general', [ReportesController::class, 'general'])->name('reportes.general');
