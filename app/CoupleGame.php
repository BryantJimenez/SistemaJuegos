<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoupleGame extends Model
{
    protected $table = 'couple_game';

    protected $fillable = ['couple_group1_id', 'couple_group2_id', 'game_id'];
}
