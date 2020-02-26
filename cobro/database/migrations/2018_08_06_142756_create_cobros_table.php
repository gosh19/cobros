<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCobrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('cobros', function (Blueprint $table) {
          $table->increments('indice');
          $table->integer('id');
          $table->string('numero_operacion');
          $table->string('tipo');
          $table->string('cant_cuotas');
          $table->integer('monto');
          $table->string('cuenta');
          $table->string('fecha');
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
        Schema::dropIfExists('cobros');
    }
}
