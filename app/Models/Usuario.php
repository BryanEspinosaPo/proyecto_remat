<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    public $timestamps = false; // tu tabla no tiene created_at/updated_at

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

    // Para que $usuario->name funcione en tu Blade (mapea a 'nombre')
    public function getNameAttribute()
    {
        return $this->nombre;
    }
}
