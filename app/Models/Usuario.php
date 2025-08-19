<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Usuario extends Model
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


    public function solicitudesRecoleccion()
    {
        return $this->hasMany(SolicitudRecoleccion::class, 'usuario_id');
    }

    /**
     * Define la relación: un Usuario tiene MUCHAS Transacciones de Puntos.
     * 
     */
    public function transaccionesPuntos()
    {
        return $this->hasMany(TransaccionPunto::class, 'usuario_id');
    }
}
