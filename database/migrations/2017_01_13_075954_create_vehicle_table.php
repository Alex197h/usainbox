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
            $table->boolean('default');
            $table->float('max_width');
            $table->float('max_length');
            $table->float('max_height');
            $table->float('max_volume');
            $table->string('car_brand');
            $table->string('car_model');
            $table->integer('id_user');
            $table->integer('id_type_vehicle');
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
