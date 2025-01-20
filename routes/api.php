<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MunicipiController;

Route::get('/municipis', [MunicipiController::class, 'index']);
Route::get('/municipis/provincia/{provincia}', [MunicipiController::class, 'byProvincia']);
Route::get('/municipis/{id}', [MunicipiController::class, 'show']);
