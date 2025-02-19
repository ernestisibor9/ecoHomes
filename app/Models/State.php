<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function property()
    {
        return $this->hasMany(Property::class);
    }

    public function city()
    {
        return $this->hasMany(City::class);
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

}
