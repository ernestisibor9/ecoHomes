<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shortlet extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationship with Facility
    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'facility_shortlet');
    }

    // Relationship with Room
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
