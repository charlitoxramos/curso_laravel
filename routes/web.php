<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('principal');
});

Route::get('/proyecto/lista',[App\Http\Controllers\ProyectoController::class,'lista']);

Route::post('/proyecto/crear',[App\Http\Controllers\ProyectoController::class,'crear'])->name('proyecto.crear');

Route::put('/proyecto/editar',[App\Http\Controllers\ProyectoController::class,'editar'])->name('proyecto.editar');

Route::delete('/proyecto/eliminar',[App\Http\Controllers\ProyectoController::class,'eliminar'])->name('proyecto.eliminar');