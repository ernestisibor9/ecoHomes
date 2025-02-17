<?php

namespace App\Http\Controllers;

use App\Models\RequestProperty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // AdminDashboard
    public function AdminDashboard()
    {
        $notifications = DB::select("SELECT users.id, users.name, users.email, COUNT(is_read)
        AS unread FROM users LEFT JOIN messages ON users.id = messages.from AND messages.is_read
        = 0 WHERE users.id = ".Auth::id()." GROUP BY users.id, users.name, users.email");
        // dd($notification);
        // exit();
        return view('admin.index', compact('notifications'));
    }
    // Admin Login
    public function AdminLogin()
    {
        return view('admin.admin_login');
    }
    // AdminLogout
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $notification = array(
            'message' => 'Logout Successfully',
            'alert-type' => 'info',
        );

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login')->with($notification);
    }
    //
    // AdminProfile
    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile', compact('profileData'));
    }
    // AdminProfileStore
    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);

        if ($request->file('photo')) {
            $file = $request->file('photo');
            // unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        // Insert Data
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // Change Password
    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password', compact('profileData'));
    }
    // Update password
    public function AdminPasswordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
        // Match the old password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = array(
                'message' => 'Old Password Does not Match',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        // Update the new password
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Password Changed Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // Manage Sellers
    public function ManageSellers(){
        $sellers = User::where('role', 'seller')->latest()->get();
        return view('admin.manage_seller', compact('sellers'));
    }
    // Approve Seller
    public function ChangeStatus($id){
        $statusId = User::findOrFail($id);

        if($statusId->status === 'pending'){
            $statusId->status = 'active';
        }
        else{
            $statusId->status = 'pending';
        }
        $statusId->save();

        $notification = array(
            'message'=> 'Status Changed to ' .  ucfirst($statusId->status),
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
    // allRequest
    public function allRequest(){
        $requests = RequestProperty::latest()->get();
        return view('admin.backend.request.all_request', compact('requests'));
    }

}
