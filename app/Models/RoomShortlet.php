<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomShortlet extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function shortlet()
    {
        return $this->belongsTo(Shortlet::class);
    }


// In the Room model
public function facilities()
{
    return $this->belongsToMany(Facility::class, 'facility_room', 'room_id', 'facility_id');
}

public function photos()
{
    return $this->hasMany(CoverPhotoShortlet::class);
}

public function multiphotos()
{
    return $this->hasMany(MultiPhotoShortlet::class);
}

public function details()
{
    return $this->hasOne(ShortletDetail::class);
}

public function roomImages() {
    return $this->hasMany(ShortletImage::class);
}

}
