<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoupleGroup extends Model
{
    protected $table = 'couple_group';

    protected $fillable = ['couple_id', 'group_id'];

    public function couple() {
		return $this->belongsTo(Couple::class);
	}

    public function couple_game() {
        return $this->hasOne(CoupleGame::class);
    }
}
