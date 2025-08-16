<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Reporte;
use App\Models\SolicitudRecoleccion; // Usaremos este modelo consistentemente
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReporteCliController extends Controller
{
    /**
     * Muestra el reporte de un usuario específico.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show(int $id): View
    {
        // 1. Carga el usuario o falla (mostrando error 404).
        $usuario = Usuario::findOrFail($id);

        // 2. Obtiene todos los reportes para las métricas generales.
        $reportes = SolicitudRecoleccion::where('usuario_id', $id)
            ->orderBy('fecha_solicitud', 'desc')
            ->get();

        // 3. Calcula las métricas.
        $pesoRecolectado = (float) $reportes->sum('peso');
        $puntosAdquiridos = (int) round($pesoRecolectado * 0.8);
        $pesoRegistrado = (float) ($reportes->first()->peso ?? 0);
        $puntosAcumulados = $puntosAdquiridos;

        // --- LÓGICA DEL GRÁFICO ---

        // 4. Obtiene los datos agrupados por mes.
        // Esta consulta es la fuente de los datos para las barras.
        $serie = SolicitudRecoleccion::selectRaw('DATE_FORMAT(fecha_recoleccion, "%Y-%m") as ym, SUM(COALESCE(peso, 0)) as total_peso')
            ->where('usuario_id', $usuario->id)
            ->whereNotNull('fecha_recoleccion') // IGNORA reportes sin fecha de recolección
            ->groupBy('ym')
            ->orderBy('ym', 'asc')
            ->get(); // El resultado es una Colección de Objetos.

        // 5. Calcula el valor máximo de peso para escalar el gráfico.
        // Si la colección está vacía o todos los pesos son 0, $maxPeso será 0 o null.
        $maxPeso = $serie->max('total_peso');

        // 6. Añade la propiedad 'height_percentage' a cada mes.
        // Usamos transform() para modificar la colección directamente.
        $serie->transform(function ($item) use ($maxPeso) {
            // Solo calcula el porcentaje si maxPeso es mayor que 0 para evitar división por cero.
            if ($maxPeso > 0) {
                $item->height_percentage = ($item->total_peso / $maxPeso) * 100;
            } else {
                // Si no hay peso, la altura de la barra es 0.
                $item->height_percentage = 0;
            }
            return $item;
        });

        // 7. Retorna la vista con los datos ya procesados.
        return view('reporte', [ // Asegúrate de que 'reporte' es el nombre correcto de tu vista.
            'usuario' => $usuario,
            'reportes' => $reportes,
            'pesoRecolectado' => $pesoRecolectado,
            'puntosAdquiridos' => $puntosAdquiridos,
            'pesoRegistrado' => $pesoRegistrado,
            'puntosAcumulados' => $puntosAcumulados,
            // Convertimos la colección final a un array para que la vista
            // pueda usar la sintaxis $item['...'] de forma segura.
            'serie' => $serie->toArray(),
        ]);
    }
}
