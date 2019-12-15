<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
	protected $fillable = ['couple_id', 'position'];

	public function tournaments() {
		return $this->belongsToMany(Tournament::class)->withTimestamps();
	}

	public function couple() {
		return $this->belongsTo(Couple::class);
	}
}
