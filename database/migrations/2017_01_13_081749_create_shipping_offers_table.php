<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingOffersTable extends Migration
{
    public function up()
    {
        Schema::create('shipping_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fixed_date');
            $table->time('fixed_hour')->nullable();
            $table->float('longitude_start');
            $table->float('latitude_start');
            $table->float('longitude_end');
            $table->float('latitude_end');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('shipping_offers');
    }
}
