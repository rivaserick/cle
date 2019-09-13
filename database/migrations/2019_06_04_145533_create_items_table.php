<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Final
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_categoria')->unsigned()->after('id');
            $table->foreign('id_categoria')->references('id')->on('categorias')->onDelete('cascade');;
            $table->string('texto_item');
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
        Schema::dropIfExists('items');
    }
}
