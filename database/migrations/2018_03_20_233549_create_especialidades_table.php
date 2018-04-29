<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecialidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especialidades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nivel_academico_id')->unsigned();
            $table->string('clave',8)->unique();
            $table->string('especialidad',128);
            $table->string('reconocimiento_oficial',64)->unique();
            $table->string('dges',64)->unique();
            $table->date('fecha_reconocimiento');
            $table->string('descripcion',255)->nullable();
            $table->integer('modalidad_id')->unsigned();
            $table->integer('tipo_plan_especialidad_id')->unsigned();

            $table->foreign('nivel_academico_id')->references('id')->on('niveles_academicos');
            $table->foreign('modalidad_id')->references('id')->on('modalidades_especialidades');
            $table->foreign('tipo_plan_especialidad_id')->references('id')->on('tipos_planes_especialidades');

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
        Schema::dropIfExists('especialidades');
    }
}
