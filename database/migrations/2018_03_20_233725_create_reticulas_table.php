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
            $table->string('reticula',128)->unique();
            $table->integer('periodo_especialidad')->nullable();
            
            $table->foreign('especialidad_id')->references('id')->on('especialidades');
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
