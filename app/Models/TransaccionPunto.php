<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaccionPunto extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     */
    protected $table = 'transacciones_puntos';

    /**
     * Indica si el modelo debe tener timestamps (created_at, updated_at).
     * Tu tabla 'transacciones_puntos' no parece tenerlos.
     */
    public $timestamps = false;

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'usuario_id',
        'tipo_transaccion',
        'puntos',
        'fecha_transaccion',
    ];

    /**
     * Define la relación inversa: una Transacción PERTENECE A un Usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
