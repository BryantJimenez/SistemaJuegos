<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = [ 'name', 'slug', 'groups', 'start', 'type', 'state'];

    public function gamers() {
        return $this->belongsToMany(Gamer::class)->withTimestamps();
    }

    public function groups() {
        return $this->hasMany(Group::class);
    }

    public function winners() {
        return $this->belongsToMany(Winner::class)->withTimestamps();
    }
}
