<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration {
    public function up() {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question');
            $table->integer('shipping_offer_id')->unsigned()->nullable();
            $table->foreign('shipping_offer_id')->references('id')->on('shipping_offers');
            $table->integer('transport_offer_id')->unsigned()->nullable();
            $table->foreign('transport_offer_id')->references('id')->on('transport_offer');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down() {
        Schema::drop('questions');
    }
}
