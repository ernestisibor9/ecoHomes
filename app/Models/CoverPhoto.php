<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoverPhoto extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rooms()
{
    return $this->belongsTo(Room::class);
}

}
