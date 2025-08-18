<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\SolicitudRecoleccion; // No lo usamos directamente, pero es bueno saber que existe
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf; // Asegúrate de tener este 'use' si usas el paquete barryvdh/laravel-dompdf

class ReporteCliController extends Controller
{
    /**
     * Muestra el reporte del cliente en la web.
     */
    public function show(int $id): View
    {
        // Obtenemos todos los datos desde un único método para asegurar consistencia.
        $data = $this->obtenerDatosReporte($id);

        return view('reporte', $data);
    }

    /**
     * Genera y descarga el reporte del cliente en PDF.
     */
    public function descargarPDF(int $id)
    {
        // Obtenemos EXACTAMENTE los mismos datos que en el método show.
        $data = $this->obtenerDatosReporte($id);

        $pdf = Pdf::loadView('reporte_pdf', $data);

        return $pdf->download('reporte-cliente-' . $data['usuario']->id . '.pdf');
    }


    private function obtenerDatosReporte(int $id): array
    {
        // 1. Busca al usuario o falla con un error 404 si no existe.
        $usuario = Usuario::findOrFail($id);

        // 2. Obtiene todos los reportes (solicitudes) usando la relación definida en el modelo Usuario.
        $reportes = $usuario->solicitudesRecoleccion()->orderBy('fecha_solicitud', 'desc')->get();

        // --- INICIO DE CÁLCULOS (CONSERVANDO TU LÓGICA ORIGINAL Y AÑADIENDO LA CORRECTA) ---

        // 3. Calcula el peso total recolectado.
        $pesoRecolectado = (float) $reportes->sum('peso');

        // 4. Calcula los puntos según tu regla de negocio (peso * 0.8).
        // Lo nombramos claramente para saber de dónde viene.
        $puntosCalculadosPorPeso = (int) round($pesoRecolectado * 0.8);

        // 5. Obtiene el peso del reporte más reciente (tu lógica para 'pesoRegistrado').
        // Renombramos la variable para que sea más clara.
        $pesoUltimoReporte = (float) ($reportes->first()->peso ?? 0);

        // 6. [LÓGICA CORRECTA] Calcula los puntos acumulados REALES desde la tabla de transacciones.
        // Esto te dará el balance verdadero del usuario.
        // ASUMO que los canjes se guardan como números positivos en la columna 'puntos' y
        // se diferencian por el 'tipo_transaccion'. Si los canjes son negativos, el cálculo es más simple.
        $puntosGanados = (int) $usuario->transaccionesPuntos()->where('tipo_transaccion', 'acumulacion')->sum('puntos');
        $puntosGastados = (int) $usuario->transaccionesPuntos()->where('tipo_transaccion', 'canje')->sum('puntos');
        $puntosAcumulados = $puntosGanados - $puntosGastados;

        // --- FIN DE CÁLCULOS ---


        // 7. Prepara los datos para el gráfico (tu código para la serie es bueno).
        $serie = $usuario->solicitudesRecoleccion()
            ->selectRaw('DATE_FORMAT(fecha_recoleccion, "%Y-%m") as ym, SUM(COALESCE(peso, 0)) as total_peso')
            ->whereNotNull('fecha_recoleccion')
            ->groupBy('ym')
            ->orderBy('ym', 'asc')
            ->get();

        $maxPeso = $serie->max('total_peso') ?? 0; // Usamos el operador ?? para evitar error si no hay serie.

        $serie->transform(function ($item) use ($maxPeso) {
            $item->height_percentage = ($maxPeso > 0) ? ($item->total_peso / $maxPeso) * 100 : 0;
            return $item;
        });

        // 8. Devuelve todos los datos en un solo array, listos para ser usados por la vista o el PDF.
        return [
            'usuario' => $usuario,
            'reportes' => $reportes,
            'pesoRecolectado' => $pesoRecolectado,
            'puntosAcumulados' => $puntosAcumulados, // El balance REAL del usuario.
            'puntosAdquiridos' => $puntosCalculadosPorPeso, // Tus puntos calculados por peso. Puedes mostrar ambos si quieres.
            'pesoRegistrado' => $pesoUltimoReporte, // Tu lógica original, pero con nombre claro.
            'serie' => $serie->toArray(),
        ];
    }
}
