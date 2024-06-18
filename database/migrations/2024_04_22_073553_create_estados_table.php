<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('default')->default('no');
            $table->string('font_color')->nullable()->default(null); // Agregar campo 'font_color' con valor predeterminado nulo
            $table->string('bg_color')->nullable()->default(null); // Agregar campo 'bg_color' con valor predeterminado nulo
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
        Schema::dropIfExists('estados');
    }
}