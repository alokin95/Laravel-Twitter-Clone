<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tweet_id')->unsigned()->index();
            $table->integer('sum');
            $table->integer('number_of_votes');
            $table->timestamps();

            $table->foreign('tweet_id')
            ->references('id')
            ->on('tweets')
            ->onDelete('cascade');
        });

        Schema::create('rating_user', function (Blueprint $table) {
            $table->integer('rating_id');
            $table->integer('user_id');
            $table->primary(['rating_id', 'user_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
        Schema::dropIfExists('rating_user');
    }
}
