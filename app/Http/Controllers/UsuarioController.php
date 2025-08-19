<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function verMisReportes()
    {
        $usuario = Auth::user();
        $reportes = $usuario->reportes;

        return view('reportes.cliente', compact('reportes', 'usuario'));
    }
}
