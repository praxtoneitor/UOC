<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAveriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('averias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nodo');
            $table->foreign('id_nodo')->references('id')->on('nodos')->onDelete('cascade');
            $table->text('descripcion');
            $table->text('solucion')->nullable();
            $table->unsignedBigInteger('susti_A')->nullable();
            $table->foreign('susti_A')->references('id')->on('material')->onDelete('set null');
            $table->unsignedBigInteger('susti_B')->nullable();
            $table->foreign('susti_B')->references('id')->on('material')->onDelete('set null');
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
        Schema::dropIfExists('averias');
    }
}