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
            $table->boolean('validated')->default(false);
            $table->integer('user_id')->unsigned();
            $table->integer('transport_id')->unsigned();
            $table->integer('shipping_id')->unsigned();
            $table->integer('city_start_id')->unsigned();
            $table->integer('city_end_id')->unsigned();
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
        Schema::drop('reservation');
    }
}
