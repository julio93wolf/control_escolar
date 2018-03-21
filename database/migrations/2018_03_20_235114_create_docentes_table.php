<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',32)->unique();
            $table->integer('datos_generales_id')->unsigned();
            $table->string('rfc',16)->unique();
            $table->integer('titulo_id')->unsigned();
            $table->integer('usuario_id')->unsigned();

            $table->foreign('datos_generales_id')->references('id')->on('datos_generales');
            $table->foreign('titulo_id')->references('id')->on('titulos');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docentes');
    }
}
