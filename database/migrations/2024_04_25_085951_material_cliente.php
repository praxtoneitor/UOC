<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('material_cliente', function (Blueprint $table) {
            $table->bigIncrements('id'); // Campo id autoincremental y PK
            $table->unsignedBigInteger('material_id'); // Campo para almacenar el ID del material
            $table->foreign('material_id')->references('id')->on('material'); // Clave foránea para relacionar con la tabla materiales
            $table->unsignedBigInteger('cliente_id'); // Campo para almacenar el ID del cliente
            $table->foreign('cliente_id')->references('id')->on('clientes'); // Clave foránea para relacionar con la tabla clientes
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_cliente');
    }
};