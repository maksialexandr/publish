<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function($table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('nickname', 255);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->boolean('gender');
            $table->string('phone', 16);
            $table->string('preview', 255);
            $table->string('position', 255);
            $table->datetime('birthday');
            $table->string('status', 255);
            $table->string('remember_token', 100);
            $table->boolean('confirmed')->default(1);
            $table->timestamp('created_at')->default(Carbon::now());
            $table->timestamp('updated_at')->default(Carbon::now());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
