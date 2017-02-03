<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStepTable extends Migration {
    public function up(){
      Schema::create('reservation_step', function (Blueprint $table) {
            $table->integer('transport_offer_id')->unsigned();
            $table->foreign('transport_offer_id')->references('id')->on('transport_offers');
            $table->float('longitude');
            $table->float('latitude');
            $table->text('label');
            $table->integer('step')->unsigned();
      });
    }

    public function down() {
      Schema::drop('reservation_step');
    }
}
