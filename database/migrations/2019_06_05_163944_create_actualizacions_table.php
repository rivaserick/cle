<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActualizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actualizacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_curso');
            $table->string('descripcion');
            $table->string('archivo');
            $table->integer('duracion');
            $table->string('instruido_por');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('id_linea_capacitacion')->unsigned();
            $table->foreign('id_linea_capacitacion')->references('id')->on('linea_capacitacions');
            $table->integer('id_sublinea_capacitacion')->unsigned();
            $table->foreign('id_sublinea_capacitacion')->references('id')->on('sublinea_capacitacions');
            $table->integer('id_profesor')->unsigned();
            $table->foreign('id_profesor')->references('id')->on('profesors');
            $table->integer('id_periodo')->unsigned();
            $table->foreign('id_periodo')->references('id')->on('periods');
            $table->integer('id_status')->unsigned();
            $table->foreign('id_status')->references('id')->on('statuses');
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
        Schema::dropIfExists('actualizacions');
    }
}
