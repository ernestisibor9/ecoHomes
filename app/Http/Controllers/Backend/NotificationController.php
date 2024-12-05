<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Show notifications view
    public function notifications()
    {
        // Fetch all notifications as Eloquent models
        $notifications = Auth::user()->notifications()->get();

        return view('notifications.index', compact('notifications'));
    }

    // Mark a single notification as read
    public function markAsRead($id)
    {
        // Fetch the notification and ensure it is an Eloquent model
        $notification = Auth::user()->notifications()->where('id', $id)->first();

        if ($notification && is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        return redirect()->back()->with('success', 'Notification marked as read');
    }

    // Mark all notifications as read
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return redirect()->back()->with('success', 'All notifications marked as read');
    }
}
