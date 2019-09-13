<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObservacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Final
        Schema::create('observacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_grupo');
            $table->foreign('id_grupo')->references('id')->on('grupos');
            $table->integer('id_observador')->unsigned();
            $table->foreign('id_observador')->references('id')->on('observadors');
            $table->date('fecha');
            $table->string('strengths_observed');
            $table->string('suggestions_improvement');
            $table->string('general_observations');
            $table->string('observees_comment')->nullable();
            $table->integer('id_teacher_self_assessment')->unsigned()->nullable();
            $table->foreign('id_teacher_self_assessment')->references('id')->on('teacher_self_assessments');
            $table->timestamp('fecha_feedback')->nullable();;
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
        Schema::dropIfExists('observacions');
    }
}
