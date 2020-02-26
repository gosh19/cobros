<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
          $table->integer('id')->primary();
          $table->string('tipo');
          $table->string('valor_cuota');
          $table->integer('cant_cuotas');
          $table->float('cuotas_pagas');
          $table->integer('valor_restante');
          $table->string('fecha_siguiente_cobro');
          $table->integer('anexos');
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
