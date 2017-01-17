<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportOfferTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('transport_offer', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('start_detour');
            $table->boolean('end_detour');
            $table->boolean('highway');
            $table->boolean('is_regular');
            $table->datetime('date_start_min');
            $table->datetime('date_start_max');
            $table->time('start_hour');
            $table->string('frenquency');
            $table->float('max_width');
            $table->float('max_length');
            $table->float('max_height');
            $table->float('max_weight');
            $table->text('description');
            $table->datetime('deposit_date');
            $table->boolean('full');
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
        Schema::drop('transport_offer');
    }
}
