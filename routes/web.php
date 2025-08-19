<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReporteCliController;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/agendamiento', function () {
    return view('agendamiento');
})->name('agendamiento');

Route::post('/store', [AppointmentController::class, 'store'])->name('appointment.store');

Route::get('/puntos', function () {
    return view('puntos');
});

Route::get('/reporte/{id}', [ReporteCliController::class, 'show'])
    ->whereNumber('id')
    ->name('reporte.usuario');

Route::get('/logout', fn() => redirect('/'))->name('logout');


Route::get('/reporte/{id}/pdf', [ReporteCliController::class, 'descargarPDF'])
    ->whereNumber('id')
    ->name('reporte.pdf');
