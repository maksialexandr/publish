<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HashTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hash_tags', function($table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer('twit_id')->unsigned();
            $table->foreign('twit_id')->references('id')->on('twits')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hash_tags');
    }
}
