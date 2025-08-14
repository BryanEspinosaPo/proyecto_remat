<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudRecoleccion extends Model
{
    protected $table = 'solicitud_recoleccion';
    protected $primaryKey = 'id';
    public $timestamps = false; // NO usamos created_at/updated_at

    protected $fillable = [
        'usuario_id',
        'cod_residuo',
        'fecha_solicitud',
        'peso',
        'fecha_recoleccion',
        'hora_prevista',
        'estado'
    ];
}
