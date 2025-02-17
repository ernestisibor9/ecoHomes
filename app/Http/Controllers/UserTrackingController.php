<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserTrackingController extends Controller
{
    //
    public function getUsersStatus()
    {
        $users = User::all();
        return view('admin.backend.property.all_property', compact('users'));
    }

    public function getGuestStatus()
    {
        $lastSeen = Session::get('guest_last_seen');
        $status = $lastSeen && Carbon::parse($lastSeen)->diffInMinutes(Carbon::now()) < 5 ? 'Online' : 'Offline';

        return view('admin.backend.property.all_property', compact('status', 'lastSeen'));
    }

    public function getOnlineUsersCount()
    {
        $onlineUsers = User::where('last_seen', '>=', Carbon::now()->subMinutes(5))->count();
        return response()->json(['online_users' => $onlineUsers]);
    }
}
