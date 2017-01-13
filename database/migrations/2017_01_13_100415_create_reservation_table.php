<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('reservation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price');
            $table->date('passage_date');
            $table->time('hour');
            $table->integer('shipping_note');
            $table->integer('transport_note');
            $table->string('shipping_review');
            $table->string('transport_review');
            $table->boolean('validated');
            $table->integer('id_user');
            $table->integer('id_transport');
            $table->integer('city_start');
            $table->integer('city_end');
            $table->integer('id_shipping');
            $table->timestamps();
            $table->sofDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('reservation');
    }
}
