<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_estudiantes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estudiante_id')->unsigned();
            $table->integer('tipo_documento_id')->unsigned();
            $table->string('documento',255)->nullable();

            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
            $table->foreign('tipo_documento_id')->references('id')->on('tipos_documentos_estudiantes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos_estudiantes');
    }
}