<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 50);
            $table->string('tipo', 15);
            $table->string('sueldo', 50);
            $table->string('organizacion', 20);
            $table->string('ubicacion', 100);
            $table->string('requisitos', 150);
            $table->string('descripcion', 300);
            $table->string('detalles', 100);
            $table->string('beneficios', 100);
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
        Schema::dropIfExists('empleos');
    }
};
