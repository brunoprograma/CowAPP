<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_place_type');
            $table->string('name');
            $table->string('description');
            $table->string('city');
            $table->string('uf');
            $table->integer('day_week');
            $table->integer('day_week');
            $table->float('latitude');
            $table->float('longitude');
            $table->integer('size');
            $table->integer('capacity');
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
        Schema::dropIfExists('places');
    }
}
