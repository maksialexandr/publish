<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice', function ($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->integer('noticeable_id');
            $table->text('noticeable_type');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notice');
    }
}
