<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeVehicleTable extends Migration {
    public function up() {
        Schema::create('type_vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
        });
    }

    public function down() {
        Schema::dropIfExists('type_vehicles');
    }
}
