<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('business_filter_id');
            $table->unsignedInteger('center_distance')->nullable();
            $table->boolean('featured')->default(0);
            $table->boolean('delivered')->default(0);
            $table->string('slug', 120)->unique();
            $table->string('title', 100);
            $table->string('image', 150);
            $table->string('title_image', 250)->nullable();
            $table->string('background_image', 250)->nullable();
            $table->string('folder_image', 150)->nullable();
            $table->string('internal_image', 250)->nullable();
            $table->string('address', 180)->default('');
            $table->string('video', 50)->nullable();
            $table->string('latitude', 25);
            $table->string('longitude', 25);
            $table->string('neighborhood', 100);
            $table->string('reference', 250)->nullable();
            $table->string('link_maps', 500)->nullable();
            $table->text('description')->nullable();
            $table->boolean('for_sale')->default(0);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
            $table->foreign('business_filter_id')->references('id')->on('business_filters');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businesses');
    }
}