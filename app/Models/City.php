<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function state(){
        return $this->belongsTo(State::class, 'state_id', 'id');
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
