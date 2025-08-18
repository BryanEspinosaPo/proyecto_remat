<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('ciudad');
            $table->string('zona');
            $table->string('codigo');
            $table->string('celular');
            $table->string('direccion');
            $table->decimal('peso', 8, 2);
            $table->string('unidad_peso');
            $table->decimal('tamano', 8, 2);
            $table->string('unidad_tamano');
            $table->string('tipo_residuo');
            $table->date('fecha_recoleccion');
            $table->string('hora_recoleccion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
