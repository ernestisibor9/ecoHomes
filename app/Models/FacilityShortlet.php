<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityShortlet extends Model
{
    use HasFactory;

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'facility_hotel');
    }
    // In the Facility model
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'facility_room', 'facility_id', 'room_id');
    }
}
