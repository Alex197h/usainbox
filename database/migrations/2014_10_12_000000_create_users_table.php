<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->boolean('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->string('phone')->nullable();
            $table->text('description')->nullable();
            $table->string('avatar')->default('default.jpg');
            $table->boolean('help_charge')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->string('provider')->nullable();
            $table->string('social_id')->unique()->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    
    public function down() {
        Schema::drop('users');
    }
}
