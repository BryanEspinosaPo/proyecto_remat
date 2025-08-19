<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;


    protected $table = 'solicitud_recoleccion';

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
