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
            $table->integer('id_teacher_self_assessment')->unsigned();
            $table->foreign('id_teacher_self_assessment')->references('id')->on('teacher_self_assessments');
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
