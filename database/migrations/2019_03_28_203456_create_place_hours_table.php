<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaceHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_hours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_place');
            $table->timestamp('initial')->nullable();
            $table->timestamp('finale')->nullable();
            $table->integer('day_week');
            $table->timestamps();
            $table->foreign('id_place')->references('id')->on('places');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('place_hours');
    }
}
