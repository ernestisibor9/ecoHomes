<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function type(){
        return $this->belongsTo(PropertyType::class, 'ptype_id', 'id');
    }

    public function seller(){
        return $this->belongsTo(SellMyProperty::class, 'seller_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function amenity()
    {
        return $this->hasMany(Amenities::class);
    }
    public function availability()
    {
        return $this->hasMany(Availability::class);
    }

    public function viewingRequests()
    {
        return $this->hasMany(ViewingRequest::class);
    }

}
