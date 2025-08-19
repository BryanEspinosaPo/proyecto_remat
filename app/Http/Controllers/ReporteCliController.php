<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class ReporteCliController extends Controller
{

    public function show(int $id): View
    {
        // Obtenemos todos los datos desde un método para asegurar consistencia.
        $data = $this->obtenerDatosReporte($id);

        return view('reporte', $data);
    }
    public function descargarPDF(int $id) // Genera y descarga el reporte del cliente en PDF.
    {
        $data = $this->obtenerDatosReporte($id);
        $pdf = Pdf::loadView('reporte_pdf', $data);
        return $pdf->download('reporte-cliente-' . $data['usuario']->id . '.pdf');
        if (empty($data['logoBase64'])) {
            Log::warning('No se pudo cargar el logo para el PDF del reporte.');
        }
    }



    private function obtenerDatosReporte(int $id): array
    {
        $usuario = Usuario::findOrFail($id);
        $reportes = $usuario->solicitudesRecoleccion()->orderBy('fecha_solicitud', 'desc')->get();
        $pesoRecolectado = (float) $reportes->sum('peso');
        $pesoUltimoReporte = (float) ($reportes->first()->peso ?? 0);
        $puntosAcumulados = (int) $usuario->transaccionesPuntos()->sum('puntos');

        $logoBase64 = null; // Inicia como nulo por si no se encuentra el archivo

        $logoPath = public_path('Images/logo.png'); // ruta de logo 

        if (file_exists($logoPath)) {
            try {
                $type = pathinfo($logoPath, PATHINFO_EXTENSION);
                $fileData = file_get_contents($logoPath);
                $logoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($fileData);
            } catch (\Exception $e) {
                Log::error('Error al leer el archivo del logo: ' . $e->getMessage());
            }
        }

        return [
            'usuario' => $usuario,
            'reportes' => $reportes,
            'pesoRecolectado' => $pesoRecolectado,
            'puntosAcumulados' => $puntosAcumulados,
            'pesoRegistrado' => $pesoUltimoReporte,
            'serie' => [],
            'logoBase64' => $logoBase64, // logo para  pdf
        ];
    }
}
