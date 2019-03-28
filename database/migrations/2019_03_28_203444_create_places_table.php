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
            $table->unsignedBigInteger('id_place_type');
            $table->unsignedBigInteger('id_user');
            $table->string('name');
            $table->string('description');
            $table->string('city');
            $table->string('uf');
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->integer('size')->nullable();
            $table->integer('capacity');
            $table->timestamps();
            $table->foreign('id_place_type')->references('id')->on('place_types');
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
        Schema::dropIfExists('places');
    }
}
