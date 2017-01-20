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
            $table->boolean('start_detour')->default(false);
            $table->boolean('end_detour')->default(false);
            $table->boolean('highway')->default(false);
            $table->boolean('is_regular')->default(false);
            $table->datetime('date_start_min');
            $table->datetime('date_start_max');
            $table->time('start_hour');
            $table->float('max_width')->default(0);
            $table->float('max_length')->default(0);
            $table->float('max_height')->default(0);
            $table->float('max_volume')->default(0);
            $table->float('max_weight');
            $table->text('description')->nullable();
            $table->datetime('deposit_date');
            $table->boolean('full')->default(false);
            $table->integer('vehicule_id');
            $table->foreign('vehicule_id')->references('id')->on('vehicule');
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
