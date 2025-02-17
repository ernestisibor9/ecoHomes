<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    // otpInput
    public function otpInput(Request $request)
    {
        $otpDelivery = $request->query('otp_delivery', 'email'); // Default to email if not provided
        return view('auth.otp-input', compact('otpDelivery'));
    }

    //
    public function verify(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        // Check if the user is already authenticated (they shouldn't be at this point)
        if (Auth::check()) {
            return redirect()->route('dashboard')->with('info', 'You are already logged in.');
        }

        // Retrieve the user based on the OTP
        $user = User::where('otp', $request->otp)
                    ->where('otp_expires_at', '>', now())
                    ->first();

        // If the user is not found or OTP is invalid/expired
        if (!$user) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        // If OTP is valid, clear the OTP fields
        $user->update([
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        // Log the user in after OTP verification
        Auth::login($user);

        // Redirect to the login page after successful OTP verification
        return redirect()->route('login')->with('success', 'OTP verified successfully. Please log in.');
    }




}
