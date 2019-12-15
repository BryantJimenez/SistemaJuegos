<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $fillable = ['name', 'slug'];

    public function couples() {
        return $this->hasMany(Couple::class);
    }
}
