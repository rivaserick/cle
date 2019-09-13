<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLoginColumnsToCoordinadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coordinadors', function (Blueprint $table) {
            $table->string('nombre')->after('id');
            $table->string('username')->unique()->nullable()->default(null)->after('nombre');
            $table->string('password')->default('')->after('username');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coordinadors', function (Blueprint $table) {
            //
        });
    }
}
