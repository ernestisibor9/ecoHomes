<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function property()
    {
        return $this->hasMany(Property::class);
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
}
