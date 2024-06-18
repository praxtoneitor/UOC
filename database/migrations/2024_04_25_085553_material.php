<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('material', function (Blueprint $table) {
            $table->bigIncrements('id'); // Campo id autoincremental y PK
            $table->string('marca'); // Campo marca
            $table->string('modelo'); // Campo modelo
            $table->string('num_serie'); // Campo num_serie
            $table->string('mac'); // Campo mac
            $table->boolean('utilizado')->default(false);
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
        Schema::dropIfExists('material');
    }
};