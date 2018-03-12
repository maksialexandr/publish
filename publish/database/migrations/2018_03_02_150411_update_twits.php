<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTwits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('twits', function (Blueprint $table) {
            $table->unsignedInteger('group_id')->default(null);
            $table->foreign('group_id')->references('id')->on('twits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('twits', function (Blueprint $table) {
            $table->dropColumn('group_id');
        });
    }
}
