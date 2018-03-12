<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserHasTwitLikes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_twit_likes', function($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('twit_id')->unsigned();
            $table->foreign('twit_id')->references('id')->on('twits')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_has_twit_likes');
    }
}
