<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReservationStepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('reservation_step', function (Blueprint $table) {
          $table->integer('reservation_id')->unsigned();
          $table->foreign('reservation_id')->references('id')->on('reservation');
          $table->float('longitude');
          $table->float('latitude');
          $table->integer('step')->unsigned();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('reservation_step');
    }
}
