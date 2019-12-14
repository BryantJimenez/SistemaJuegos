<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Couple extends Model
{
	protected $fillable = [ 'player1_id', 'player2_id', 'club_id'];

    public function gamer() {
		return $this->belongsTo(Gamer::class);
	}

	public function club() {
		return $this->belongsTo(Club::class);
	}
}
