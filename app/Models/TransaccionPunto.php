<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaccionPunto extends Model
{
    use HasFactory;


    protected $table = 'transacciones_puntos';

    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'tipo_transaccion',
        'puntos',
        'fecha_transaccion',
    ];


    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
