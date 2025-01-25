<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }


// In the Room model
public function facilities()
{
    return $this->belongsToMany(Facility::class, 'facility_room', 'room_id', 'facility_id');
}

public function photos()
{
    return $this->hasMany(CoverPhoto::class);
}

public function multiphotos()
{
    return $this->hasMany(MultiPhoto::class);
}

}
