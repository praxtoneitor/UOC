<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelacionMaterialNodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rel_material_nodos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_material');
            $table->unsignedBigInteger('id_nodo');
            $table->string('ip')->nullable();
            $table->string('alias')->nullable();
            

            // Definir las claves foráneas
            $table->foreign('id_material')->references('id')->on('material')->onDelete('cascade');
            $table->foreign('id_nodo')->references('id')->on('nodos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rel_material_nodos');
    }
}