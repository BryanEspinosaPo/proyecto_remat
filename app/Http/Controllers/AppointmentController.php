<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'zona' => 'nullable|string|max:255',
            'codigo' => 'nullable|string|max:20',
            'celular' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'peso' => 'required|numeric',
            'unidad_peso' => 'required|in:kg,g,lb',
            'tamano' => 'required|numeric',
            'unidad_tamano' => 'required|in:cm2,m2',
            'tipo_residuo' => 'required|string|max:255',
            'fecha_recoleccion' => 'required|date',
            'hora_recoleccion' => 'required|string',
        ]);

        try {
            // When database is ready, uncomment this
            /*
            $appointment = Appointment::create($validated);
            return redirect()->back()->with('success', 'Recolección agendada exitosamente');
            */

            // Temporary response until database is ready
            return redirect()->back()->with('success', 'Solicitud procesada exitosamente (modo prueba)');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Hubo un error al procesar su solicitud. Por favor intente nuevamente.']);
        }
    }
}
