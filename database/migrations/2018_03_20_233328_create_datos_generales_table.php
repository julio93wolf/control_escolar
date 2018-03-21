<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosGeneralesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_generales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('curp',18)->unique();
            $table->string('nombre',32);
            $table->string('apaterno',32);
            $table->string('amaterno',32);
            $table->date('fecha_nacimiento');
            $table->string('calle_numero',64);
            $table->string('colonia',32);
            $table->integer('localidad_id')->unsigned();
            $table->string('telefono_casa')->nullable();
            $table->string('telefono_personal')->nullable();
            $table->integer('estado_civil_id')->unsigned();
            $table->enum('F',['M','O']);
            $table->date('fecha_registro');
            $table->integer('nacionalidad_id')->unsigned();
            $table->string('email',128)->unique()->nullable();
            $table->string('foto',64)->unique()->nullable();
            
            $table->foreign('localidad_id')->references('id')->on('localidades');
            $table->foreign('estado_civil_id')->references('id')->on('estado_civil');
            $table->foreign('nacionalidad_id')->references('id')->on('nacionalidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_generales');
    }
}
