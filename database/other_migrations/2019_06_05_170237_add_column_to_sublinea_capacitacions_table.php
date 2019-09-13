<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToSublineaCapacitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sublinea_capacitacions', function (Blueprint $table) {
            $table->string('nombre');
            $table->integer('id_linea_capacitacion')->unsigned();
            $table->foreign('id_linea_capacitacion')->references('id')->on('linea_capacitacions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sublinea_capacitacions', function (Blueprint $table) {
            $table->dropColumn('nombre');
            $table->dropColumn('id_linea_capacitacion');
        });
    }
}
