<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToObservacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('observacions', function (Blueprint $table) {
            //$table->string('observees_comment')->nullable('false');
            //$table->integer('id_teacher_self_assessment')->nullable('false');
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
