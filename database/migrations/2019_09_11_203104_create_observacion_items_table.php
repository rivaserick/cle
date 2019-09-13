<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservacionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Final
        Schema::create('observacion_items', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->integer('id_observacion')->unsigned();
            $table->foreign('id_observacion')->references('id')->on('observacions');
            $table->integer('id_item')->unsigned();
            $table->foreign('id_item')->references('id')->on('items');
            $table->integer('score_item')->unsigned();
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
        Schema::dropIfExists('observacion_items');
    }
}
