<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReporteCliController;

Route::get('/reporte/{id}', [ReporteCliController::class, 'show'])
    ->whereNumber('id')
    ->name('reporte.usuario');

Route::get('/logout', function () {
    return redirect('/'); // o donde quieras redirigir
})->name('logout');
