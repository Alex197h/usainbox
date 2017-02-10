<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingOffersTable extends Migration {
    public function up() {
      Schema::create('shipping_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->nullable();
            $table->float('max_length');
            $table->float('max_width');
            $table->float('max_height');
            $table->float('max_weight');
            $table->float('max_price');
            $table->float('fixed_price')->nullable();
            $table->date('fixed_date');
            $table->dateTime('fixed_hour')->nullable();
            $table->integer('carrier_note')->nullable();
            $table->string('carrier_notice')->nullable();
            $table->integer('user_shipping_id');
            $table->foreign('user_shipping_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
      });
    }

    public function down() {
      Schema::drop('shipping_offers');
    }
}
