<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidenciasTable extends Migration
{
    public function up()
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->unsignedBigInteger('id_tecnico');
            $table->foreign('id_tecnico')->references('id')->on('users');
            $table->string('via_comunicacion');
            $table->string('tipo_incidencia');
            $table->boolean('necesita_visita')->default(false);
            $table->date('fecha_visita')->nullable();
            $table->text('descripcion');
            $table->text('solucion')->nullable();
            $table->string('estado')->default('abierto'); // Campo estado como varchar con valor por defecto
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('incidencias');
    }
}