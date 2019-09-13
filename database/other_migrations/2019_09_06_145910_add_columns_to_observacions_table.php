<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToObservacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('observacions', function (Blueprint $table) {
            $table->dropColumn('codigo_grupo');
            $table->dropColumn('salon');
            $table->dropColumn('hora_inicio');
            $table->dropColumn('hora_fin');
            $table->dropColumn('observaciones');
            $table->dropColumn('calificacion');
            $table->integer('id_grupo')->unsigned();
            $table->foreign('id_grupo')->references('id')->on('grupos');
            $table->string('strengths_observed');
            $table->string('suggestions_improvement');
            $table->string('general_observations');
            $table->string('observees_comment');
            //$table->integer('id_teacher_self_assessment')->unsigned();
            //$table->foreign('id_teacher_self_assessment')->references('id')->on('teacher_self_assessments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('observacions', function (Blueprint $table) {
            //
        });
    }
}
