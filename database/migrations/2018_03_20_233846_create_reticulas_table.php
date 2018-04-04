<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReticulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reticulas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('especialidad_id')->unsigned();
            $table->integer('asignatura_id')->unsigned();
            $table->integer('tipo_plan_reticula_id')->unsigned();
            $table->tinyInteger('periodo_especialidad');
            
            $table->foreign('especialidad_id')->references('id')->on('especialidades');
            $table->foreign('asignatura_id')->references('id')->on('asignaturas');
            $table->foreign('tipo_plan_reticula_id')->references('id')->on('tipos_planes_reticulas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reticulas');
    }
}
