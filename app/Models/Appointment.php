<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'ciudad',
        'zona',
        'codigo',
        'celular',
        'direccion',
        'peso',
        'unidad_peso',
        'tamano',
        'unidad_tamano',
        'tipo_residuo',
        'fecha_recoleccion',
        'hora_recoleccion'
    ];
}
