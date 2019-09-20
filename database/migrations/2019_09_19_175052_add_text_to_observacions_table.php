<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTextToObservacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Final
        Schema::table('observacions', function (Blueprint $table) {
            $table->timeTZ('hora_inicio')->nullable();
            $table->timeTZ('hora_hora_fin')->nullable();
            $table->text('strengths_observed_text')->nullable();
            $table->text('suggestions_improvement_text')->nullable();
            $table->text('general_observations_text')->nullable();
            $table->text('observees_comment_text')->nullable();
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
