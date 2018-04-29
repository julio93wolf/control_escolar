<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanesEspecialidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planes_especialidades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plan_especialidad',32)->unique();
            $table->tinyInteger('periodos');
            $table->string('descripcion',255)->nullable();
            $table->integer('especialidad_id')->unsigned();
            
            $table->foreign('especialidad_id')->references('id')->on('especialidades');

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planes_especialidades');
    }
}
