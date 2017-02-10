<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration {
    public function up() {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price');
            $table->date('passage_date');
            $table->time('hour');
            $table->integer('shipping_note');
            $table->integer('transport_note');
            $table->string('shipping_review');
            $table->string('transport_review');
            $table->boolean('validated')->default(false);
            $table->integer('transport_offer_id')->unsigned()->nullable();
            $table->foreign('transport_offer_id')->references('id')->on('transport_offers');
            $table->integer('shipping_offer_id')->unsigned()->nullable();
            $table->foreign('shipping_offer_id')->references('id')->on('shipping_offers');
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
