<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortletImage extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'image_path'];

    public function room() {
        return $this->belongsTo(RoomShortlet::class);
    }
}
