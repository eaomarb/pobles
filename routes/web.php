<?php

use App\Http\Controllers\MunicipiController;
use Illuminate\Support\Facades\Route;

Auth::routes();
Auth::routes();

Route::get('/', [MunicipiController::class, 'provincies'])->name('municipis.provincies');
Route::get('/municipi/{municipi}', [MunicipiController::class, 'show'])->name('municipis.show');
Route::get('/municipis/{id}/edit', [MunicipiController::class, 'edit'])->name('municipis.edit');
Route::put('/municipis/{municipi}', [MunicipiController::class, 'update'])->name('municipis.update');
Route::get('/municipis', [MunicipiController::class, 'index'])->name('municipis.index');
Route::get('/municipis/provincia/{provincia}', [MunicipiController::class, 'municipisPerProvincia'])->name('municipis.provincia');
Route::get('/municipi/{id}', [MunicipiController::class, 'show'])->name('municipis.showById');
Route::resource('municipis', MunicipiController::class);

Route::get('municipis/{id}', [MunicipiController::class, 'show'])->name('municipis.show');
Route::get('municipis/{id}/edit', [MunicipiController::class, 'edit'])->name('municipis.edit');
Route::get('municipis', [MunicipiController::class, 'index'])->name('municipis.index');

Route::prefix('api')->group(function () {
    Route::get('', [MunicipiController::class, 'indexApi']);
});
