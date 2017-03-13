<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportOffersTable extends Migration {
    public function up() {
        Schema::create('transport_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('detour')->default(false);
            $table->boolean('highway')->default(false);
            $table->boolean('is_regular')->default(false);
            $table->datetime('date_start');
            $table->float('max_width')->default(0);
            $table->float('max_length')->default(0);
            $table->float('max_height')->default(0);
            $table->float('max_volume')->default(0);
            $table->float('max_weight')->default(0);
            $table->text('description')->nullable();
            $table->boolean('full')->default(false);
            $table->integer('vehicle_id');
            $table->foreign('vehicle_id')->references('id')->on('vehicule');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::drop('transport_offers');
    }
}
