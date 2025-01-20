<?php

use App\Http\Controllers\MunicipiController;
use Illuminate\Support\Facades\Route;

Auth::routes();
Auth::routes();

// Ruta principal para las provincias
Route::get('/', [MunicipiController::class, 'provincies'])->name('municipis.provincies');

// Ruta para mostrar los detalles de un municipio
Route::get('/municipi/{municipi}', [MunicipiController::class, 'show'])->name('municipis.show');

// Ruta para mostrar la lista de municipios
Route::get('/municipis/provincia/{provincia}', [MunicipiController::class, 'index'])->name('municipis.index');

// Ruta para mostrar los municipios por provincia
Route::get('/municipis/provincia/{provincia}', [MunicipiController::class, 'municipisPerProvincia'])->name('municipis.provincia');

// Ruta para editar un municipio
Route::get('/municipis/{id}/edit', [MunicipiController::class, 'edit'])->name('municipis.edit');

// Ruta para actualizar un municipio
Route::put('/municipis/{municipi}', [MunicipiController::class, 'update'])->name('municipis.update');

// Asegúrate de que las rutas de autenticación están configuradas

Route::get('/municipis', [MunicipiController::class, 'index'])->name('municipis.index');