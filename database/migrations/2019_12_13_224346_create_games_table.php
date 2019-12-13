<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('couple_group1_id')->unsigned();
            $table->bigInteger('couple_group2_id')->unsigned();
            $table->bigInteger('winner_id')->unsigned();
            $table->string('type');
            $table->enum('state', [1, 2, 3]);
            $table->integer('points1')->unsigned();
            $table->integer('points2')->unsigned();
            $table->timestamps();

            #Relations
            $table->foreign('couple_group1_id')->references('id')->on('couple_group')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('couple_group2_id')->references('id')->on('couple_group')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('winner_id')->references('id')->on('couple_group')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
