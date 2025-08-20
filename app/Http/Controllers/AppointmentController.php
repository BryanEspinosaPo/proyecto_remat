<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'nullable|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:255',
            'zona' => 'nullable|string|max:255',
            'codigo' => 'nullable|string|max:20',
            'celular' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'peso' => 'nullable|numeric',
            'unidad_peso' => 'nullable|in:kg,g,lb',
            'tamano' => 'nullable|numeric',
            'unidad_tamano' => 'nullable|in:cm2,m2',
            'tipo_residuo' => 'nullable|string|max:255',
            'fecha_recoleccion' => 'nullable|string',
            'hora_recoleccion' => 'nullable|string',
        ]);

      try {
    // Cuando la base de datos esté lista, descomenta esta línea
    
    $appointment = Appointment::create($validated);
    
    // Pasar el mensaje para mostrarlo en la vista
    return redirect()->route('agendamiento')->with('alert', 'Su registro es exitoso');
} catch (\Exception $e) {
    dd($e->getMessage());
}
    }
}
