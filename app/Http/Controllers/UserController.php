<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Index
    public function Index(){
        return view('frontend.index');
    }
    // UserDashboard
    public function UserDashboard(){
        return view('frontend.dashboard.index');
    }
    // User Logout
    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $notification = array(
            'message' => 'Logout Successfully',
            'alert-type' => 'info',
        );

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with($notification);
    }
}
