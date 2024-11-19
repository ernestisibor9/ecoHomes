<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    // SellerSignup
    public function SellerSignup()
    {
        return view('frontend.seller.seller_register');
    }

    // SellerLogin
    public function SellerLogin()
    {
        return view('frontend.seller.seller_login');
    }

    // SellerDashboard
    public function SellerDashboard()
    {
        return view('frontend.seller.index');
    }

    // Store Seller
    public function SellerRegister(Request $request)
    {


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'seller',
            'status' => '0',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::SELLER);
        // return view('auth.login');

    }
    // Seller Logout
    public function SellerLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $notification = array(
            'message' => 'Logout Successfully',
            'alert-type' => 'info',
        );

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/seller/login')->with($notification);
    }
    // SellerProfile
    public function SellerProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('frontend.seller.seller_profile', compact('profileData'));
    }
        // AdminProfileStore
        public function SellerProfileStore(Request $request)
        {
            $id = Auth::user()->id;
            $data = User::find($id);

            $request->validate([
                 'photo' => 'image|mimes:jpeg,png,jpg,gif|max:1024'
            ]);

            if ($request->file('photo')) {
                $file = $request->file('photo');
                // unlink(public_path('upload/admin_images/' . $data->photo));
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/seller_images'), $filename);
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
                'message' => 'Seller Profile Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
}
