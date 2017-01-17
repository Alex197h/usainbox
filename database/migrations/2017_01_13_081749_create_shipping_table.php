<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('shipping', function (Blueprint $table) {
          $table->increments('id');
          $table->date('earliest_date');
          $table->date('latest_date');
          $table->string('description');
          $table->float('obj_length');
          $table->float('obj_width');
          $table->float('obj_height');
          $table->float('obj_weight');
          $table->float('max_price');
          $table->float('price_fixed');
          $table->date('date_fixed');
          $table->dateTime('hour_fixed');
          $table->integer('carrier_note');
          $table->string('carrier_notice');
          $table->integer('id_user_shipping');
          $table->integer('id_user_carrier');
          $table->timestamps();
          $table->softDeletes();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('shipping');
    }
}
