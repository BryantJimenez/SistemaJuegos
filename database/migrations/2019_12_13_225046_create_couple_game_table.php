<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoupleGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couple_game', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('couple_group1_id')->unsigned();
            $table->bigInteger('couple_group2_id')->unsigned();
            $table->bigInteger('game_id')->unsigned();
            $table->timestamps();

            #Relations
            $table->foreign('couple_group1_id')->references('id')->on('couple_group')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('couple_group2_id')->references('id')->on('couple_group')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('couple_game');
    }
}
