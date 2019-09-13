<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Final
        Schema::create('mensajes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mensaje');
            $table->integer('id_actualizacion')->unsigned();
            $table->foreign('id_actualizacion')->references('id')->on('actualizacions');
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
        Schema::dropIfExists('mensajes');
    }
}
