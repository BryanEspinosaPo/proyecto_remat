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
            $table->string('zona')->nullable();
            $table->string('codigo', 20)->nullable();
            $table->string('celular');
            $table->string('direccion');
            $table->decimal('peso', 8, 2);
            $table->string('unidad_peso');
            $table->decimal('tamano', 8, 2);
            $table->string('unidad_tamano');
            $table->string('tipo_residuo');
            $table->date('fecha_recoleccion')->nullable();
            $table->string('hora_recoleccion', 5)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
