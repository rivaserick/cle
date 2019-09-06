<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLoginColumnsToProfesorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profesors', function (Blueprint $table) {
            $table->string('username')->unique()->nullable()->default(null);
            $table->string('password')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profesors', function (Blueprint $table) {
            //
        });
    }
}
