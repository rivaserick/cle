<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOriginalpasswordToManyTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coordinadors', function (Blueprint $table) {
            $table->string('original_password')->nullable();
        });
        Schema::table('observadors', function (Blueprint $table) {
            $table->string('original_password')->nullable();
        });
        Schema::table('profesors', function (Blueprint $table) {
            $table->string('original_password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('many_tables', function (Blueprint $table) {
            //
        });
    }
}
