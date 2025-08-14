<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    // Si el nombre de tu tabla es "reportes" (plural), Laravel lo detectará automáticamente. 
    // Si el nombre de la tabla en tu base de datos es diferente (por ejemplo, "proyect_reciclaje"), 
    // debes especificarlo así:
    protected $table = 'solicitud_recoleccion';

    // Puedes especificar las columnas "fillable" si es necesario.
    // protected $fillable = ['columna1', 'columna2', 'etc'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
