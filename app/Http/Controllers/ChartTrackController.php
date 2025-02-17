<?php

namespace App\Http\Controllers;

use App\Models\UserActivity;
use Illuminate\Http\Request;

class ChartTrackController extends Controller
{
    //

    public function trackAction(Request $request)
{
    UserActivity::create([
        'user_id' => auth()->id(),
        'action' => $request->action, // Example: 'phone_number_clicked'
    ]);

    return response()->json(['message' => 'Activity tracked successfully']);
}

//
public function getChartData()
{
    $users = UserActivity::count();
    $phoneClicks = UserActivity::where('action', 'phone_number_clicked')->count();
    $pageViews = UserActivity::where('action', 'page_view')->count();
    $onlineUsers = UserActivity::where('created_at', '>=', now()->subMinutes(5))->distinct('user_id')->count();

    return response()->json([
        'phoneClicks' => $phoneClicks,
        'pageViews' => $pageViews,
        'onlineUsers' => $onlineUsers,
        'users' => $users,
    ]);
}
}
