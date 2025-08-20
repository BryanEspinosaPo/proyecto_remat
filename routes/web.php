<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReporteCliController;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('landing');   
})->name('landing');


Route::get('/landingInside', function () {
    return view('landingInside');   
})->name('landingInside');

Route::get('/agendamiento', function () {
    return view('agendamiento');   
})->name('agendamiento');


Route::get('/login', function () {
    return view('login');   
})->name('login');

Route::get('/registro', function () {
    return view('registro');   
})->name('registro');


Route::get('/agendamiento', function () {
    return view('agendamiento');   
})->name('agendamiento');

Route::get('/reporte/{id}', [ReporteCliController::class, 'show'])
    ->whereNumber('id')
    ->name('reporte.usuario');

Route::get('/logout', fn() => redirect('/'))->name('logout');


    Route::get('/puntos', function () {
    return view('puntos');   
})->name('puntos');



Route::get('/reporte/{id}/pdf', [ReporteCliController::class, 'descargarPDF'])
    ->whereNumber('id')
    ->name('reporte.pdf');

Route::post('/store', [AppointmentController::class, 'store'])->name('appointment.store');
