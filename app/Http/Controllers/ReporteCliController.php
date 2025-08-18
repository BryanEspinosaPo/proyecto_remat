<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Reporte;
use App\Models\SolicitudRecoleccion;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReporteCliController extends Controller
{
    /**
     * Muestra el reporte 
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show(int $id): View
    {

        $usuario = Usuario::findOrFail($id);


        $reportes = SolicitudRecoleccion::where('usuario_id', $id)
            ->orderBy('fecha_solicitud', 'desc')
            ->get();

        //  Calcula las métricas.
        $pesoRecolectado = (float) $reportes->sum('peso');
        $puntosAdquiridos = (int) round($pesoRecolectado * 0.8);
        $pesoRegistrado = (float) ($reportes->first()->peso ?? 0);
        $puntosAcumulados = $puntosAdquiridos;


        $serie = SolicitudRecoleccion::selectRaw('DATE_FORMAT(fecha_recoleccion, "%Y-%m") as ym, SUM(COALESCE(peso, 0)) as total_peso')
            ->where('usuario_id', $usuario->id)
            ->whereNotNull('fecha_recoleccion')
            ->groupBy('ym')
            ->orderBy('ym', 'asc')
            ->get();

        $maxPeso = $serie->max('total_peso');


        $serie->transform(function ($item) use ($maxPeso) {

            if ($maxPeso > 0) {
                $item->height_percentage = ($item->total_peso / $maxPeso) * 100;
            } else {
                // Si no hay peso, la altura de la barra es 0.
                $item->height_percentage = 0;
            }
            return $item;
        });


        return view('reporte', [
            'usuario' => $usuario,
            'reportes' => $reportes,
            'pesoRecolectado' => $pesoRecolectado,
            'puntosAdquiridos' => $puntosAdquiridos,
            'pesoRegistrado' => $pesoRegistrado,
            'puntosAcumulados' => $puntosAcumulados,
            'serie' => $serie->toArray(),
        ]);
    }
}
