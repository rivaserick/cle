<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMensajeAndIdActualizacionToMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mensajes', function (Blueprint $table) {
            $table->string('mensaje');
            $table->integer('id_actualizacion')->unsigned();
            $table->foreign('id_actualizacion')->references('id')->on('actualizacions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mensajes', function (Blueprint $table) {
            //
        });
    }
}
