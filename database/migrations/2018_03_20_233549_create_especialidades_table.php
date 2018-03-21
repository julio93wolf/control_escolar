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
            $table->integer('nivel_adacemico_id')->unsigned();
            $table->string('clave',8)->unique();
            $table->string('especialidad',128)->unique();
            $table->string('reconocimiento_oficial',64)->unique();
            $table->string('dges',64)->unique();
            $table->date('fecha_reconocimiento');
            $table->string('descripcion',255)->nullable();

            $table->foreign('nivel_adacemico_id')->references('id')->on('niveles_academicos');
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
