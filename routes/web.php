<?php

use App\Http\Controllers\ReporteCliController;
use Illuminate\Support\Facades\Route;

// ... otras rutas

Route::get('/reporte', [ReporteCliController::class, 'reporte']);
