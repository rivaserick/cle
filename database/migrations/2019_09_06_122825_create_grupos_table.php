<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Final
        Schema::create('grupos', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('id_periodo')->nullable();
            $table->string('grupo')->nullable();            
            $table->integer('id_profesor')->unsigned()->after('id');
            $table->foreign('id_profesor')->references('id')->on('profesors')->onDelete('cascade');
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
        Schema::dropIfExists('grupos');
    }
}
