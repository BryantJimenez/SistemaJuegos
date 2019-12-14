<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = [ 'name', 'slug', 'groups', 'type', 'state'];

    public function groups() {
        return $this->hasMany(Group::class);
    }
}
