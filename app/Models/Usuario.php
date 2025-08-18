<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// Nota: Normalmente este modelo extiende 'Authenticatable' para la autenticación de Laravel.
// Si tu sistema de login funciona, puedes dejarlo como está.
// use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Model // extends Authenticatable
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'tipo_doc',
        'num_doc',
        'password',
        'rol',
        'email',
        'nombre',
        'ciudad',
        'direccion',
        'zona',
        'cel'
    ];


    public function getNameAttribute()
    {
        return $this->nombre;
    }

    // --- INICIO DE CÓDIGO A AÑADIR ---

    /**
     * Define la relación: un Usuario tiene MUCHAS Solicitudes de Recolección.
     * Esto nos permite llamar a $usuario->solicitudesRecoleccion en el controlador.
     */
    public function solicitudesRecoleccion()
    {
        return $this->hasMany(SolicitudRecoleccion::class, 'usuario_id');
    }

    /**
     * Define la relación: un Usuario tiene MUCHAS Transacciones de Puntos.
     * Esto es VITAL para calcular el balance real de puntos.
     */
    public function transaccionesPuntos()
    {
        return $this->hasMany(TransaccionPunto::class, 'usuario_id');
    }

    // --- FIN DE CÓDIGO A AÑADIR ---
}
