<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ratings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('issue_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('type');
            $table->timestamps();
        });

        Schema::table('issue_ratings', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('issue_id')->references('id')->on('issues');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issue_ratings');
    }
}
