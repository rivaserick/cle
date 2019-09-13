<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfesorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Final
        Schema::create('profesors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre')->after('id');
            $table->string('mcer');
            $table->string('username')->unique()->nullable()->default(null)->after('nombre');
            $table->string('password')->default('')->after('username');
            $table->string('original_password')->nullable();
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
        Schema::dropIfExists('profesors');
    }
}
