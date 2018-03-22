<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosTitulacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_titulacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_id')->unsigned();
            $table->integer('titulo_id')->unsigned();
            $table->string('documento',255)->nullable();
            
            $table->foreign('tipo_id')->references('id')->on('tipos_documentos_titulacion');
            $table->foreign('titulo_id')->references('id')->on('titulaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos_titulacion');
    }
}
