<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\SolicitudRecoleccion;
use Illuminate\Support\Facades\DB;

class ReporteCliController extends Controller
{
    public function show(int $id)
    {
        // 1) Usuario
        $usuario = Usuario::findOrFail($id);

        // 2) Historial del usuario (ordenado por id DESC)
        $reportes = SolicitudRecoleccion::where('usuario_id', $id)
            ->orderBy('id', 'desc')
            ->get();

        // 3) Métricas básicas
        $pesoRecolectado   = (float) $reportes->sum('peso');
        $puntosAdquiridos  = (int) round($pesoRecolectado * 0.8); // Ejemplo
        $pesoRegistrado    = (float) optional($reportes->first())->peso ?? 0;
        $puntosAcumulados  = $puntosAdquiridos; // Cambiar si hay otra lógica

        // 4) Serie para gráfico (últimos 6 meses)
        $serie = DB::table('solicitud_recoleccion')
            ->selectRaw("
                COALESCE(
                    DATE_FORMAT(fecha_recoleccion, '%Y-%m'),
                    DATE_FORMAT(fecha_solicitud,  '%Y-%m')
                ) as ym,
                SUM(peso) as total
            ")
            ->where('usuario_id', $id)
            ->groupBy('ym')
            ->orderBy('ym', 'desc')
            ->limit(6)
            ->get()
            ->reverse()
            ->values();

        $totales = $serie->pluck('total')->map(fn($v) => (float) $v)->toArray();
        $max     = max(1, (count($totales) ? max($totales) : 1));
        $bars    = array_map(fn($v) => round(($v / $max) * 100, 2), $totales);

        // Rellenamos para que siempre haya 6 barras
        if (count($bars) < 6) {
            $bars = array_pad($bars, 6, 0);
        }

        return view('reporte', compact(
            'usuario',
            'reportes',
            'pesoRecolectado',
            'puntosAdquiridos',
            'pesoRegistrado',
            'puntosAcumulados',
            'bars'
        ));
    }
}
