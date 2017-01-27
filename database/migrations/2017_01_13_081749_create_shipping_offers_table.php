<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('shipping_offers', function (Blueprint $table) {
          $table->increments('id');
          $table->date('earliest_date');
          $table->date('latest_date');
          $table->string('description')->nullable();
          $table->float('max_length');
          $table->float('max_width');
          $table->float('max_height');
          $table->float('max_weight');
          $table->float('max_price');
          $table->float('fixed_price');
          $table->date('date_fixed');
          $table->dateTime('hour_fixed');
          $table->integer('carrier_note');
          $table->string('carrier_notice');
          $table->integer('user_shipping_id');
          $table->foreign('user_shipping_id')->references('id')->on('users');
          $table->integer('user_carrier_id')->nullable(); // A voir si utilisé (absurde)
          $table->foreign('user_carrier_id')->references('id')->on('users');
          $table->timestamps();
          $table->softDeletes();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('shipping_offers');
    }
}
