<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});
Route::get('/agendamiento', function () {
    return view('agendamiento');
});
Route::get('/puntos', function () {
    return view('puntos');
});
