<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentWinnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournament_winner', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tournament_id')->unsigned();
            $table->bigInteger('couple_id')->unsigned();
            $table->enum('position', [1, 2]);
            $table->timestamps();

            #Relations
            $table->foreign('tournament_id')->references('id')->on('tournaments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('couple_id')->references('id')->on('couples')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournament_winner');
    }
}
