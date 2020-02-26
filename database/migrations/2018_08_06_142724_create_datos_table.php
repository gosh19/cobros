<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('datos', function (Blueprint $table) {
          $table->integer('id')->primary();
          $table->string('nombre');
          $table->string('dni');
          $table->string('mail');
          $table->string('telefono');
          $table->string('tarjeta');
          $table->string('tipo_tarjeta');
          $table->string('fechaingreso');
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
        Schema::dropIfExists('datos');
    }
}
