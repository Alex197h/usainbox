<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('vehicle', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('default')->default(false);
            $table->float('max_width')->default(0);
            $table->float('max_length')->default(0);
            $table->float('max_height')->default(0);
            $table->float('max_volume')->default(0);
            $table->string('car_brand');
            $table->string('car_model');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('type_vehicle_id')->unsigned();
            $table->foreign('type_vehicle_id')->references('id')->on('type_vehicle');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('vehicle');
    }
}
