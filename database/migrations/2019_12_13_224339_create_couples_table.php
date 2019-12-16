<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couples', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('player1_id')->unsigned();
            $table->bigInteger('player2_id')->unsigned();
            $table->bigInteger('club_id')->unsigned()->nullable();
            $table->timestamps();

            #Relations
            $table->foreign('player1_id')->references('id')->on('gamers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('player2_id')->references('id')->on('gamers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('club_id')->references('id')->on('clubs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('couples');
    }
}
