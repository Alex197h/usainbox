<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration {
    public function up() {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price')->nullable();
            $table->date('passage_date');
            $table->time('hour')->nullable();
            $table->integer('shipping_note')->nullable();
            $table->integer('transport_note')->nullable();
            $table->string('shipping_review')->nullable();
            $table->string('transport_review')->nullable();
            $table->boolean('validated')->default(false);
            $table->integer('transport_offer_id')->unsigned();
            $table->foreign('transport_offer_id')->references('id')->on('transport_offers');
            $table->integer('shipper_id')->unsigned();
            $table->foreign('shipper_id')->references('id')->on('users');
            $table->float('city_start_longitude');
            $table->float('city_start_latitude');
            $table->text('city_start_label');
            $table->float('city_end_longitude');
            $table->float('city_end_latitude');
            $table->text('city_end_label');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::drop('reservations');
    }
}
