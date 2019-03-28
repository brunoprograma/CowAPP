<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaceLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_place');
            $table->unsignedInteger('id_user');
            $table->timestamp('initial');
            $table->timestamp('finale');
            $table->float('value');
            $table->timestamps();
            $table->foreign('id_place')->references('id')->on('places');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('place_locations');
    }
}
