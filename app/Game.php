<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['slug', 'type', 'state', 'points1', 'points2'];

    public function couples_groups() {
        return $this->hasMany(CoupleGame::class);
    }
}
