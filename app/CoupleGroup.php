<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoupleGroup extends Model
{
    protected $fillable = [ 'name', 'lastname', 'photo', 'slug'];

    public function couples() {
        return $this->hasMany(Couple::class);
    }
}
