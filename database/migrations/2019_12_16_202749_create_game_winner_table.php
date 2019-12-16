<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameWinnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_winner', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('couple_game_id')->unsigned();
            $table->bigInteger('winner_id')->unsigned();
            $table->timestamps();

            #Relations
            $table->foreign('couple_game_id')->references('id')->on('couple_game')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('winner_id')->references('id')->on('winners')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_winner');
    }
}
