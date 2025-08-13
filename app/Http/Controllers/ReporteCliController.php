<?php

namespace App\Http\Controllers;

use App\Models\Reporte; // Asegúrate de importar el modelo 'Reporte'
use Illuminate\Http\Request;

class ReporteCliController extends Controller
{
    /**
     * Muestra una lista de todos los registros del reporte.
     *
     * @return \Illuminate\View\View
     */
    public function reporte()
    {
        // Obtiene todos los registros de la tabla asociada al modelo Reporte
        $reportes = Reporte::all();

        // Pasa los datos a la vista 'reporte.blade.php'
        return view('reporte', compact('reportes'));
    }
}
