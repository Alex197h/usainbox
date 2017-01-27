<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
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
            $table->integer('user_id')->unsigned();
            $table->integer('transport_id')->unsigned();
            $table->integer('shipping_id')->unsigned();
            $table->float('city_start_longitude');
            $table->float('city_start_latitude');
            $table->float('city_end_longitude');
            $table->float('city_end_latitude');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('reservations');
    }
}
