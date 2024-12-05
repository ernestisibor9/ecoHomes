<?php

namespace App\Models;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends DatabaseNotification
{
    use HasFactory;

    // Since you're using UUID, this should already be handled by the DatabaseNotification class.
    protected $keyType = 'string';  // Ensures that UUID is treated as a string key.
}
