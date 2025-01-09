<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\GuestOtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class GuestController extends Controller
{
    //
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = $request->input('email');
        $otp = rand(100000, 999999);
        $name = 'Guest';

        // Log details for debugging
        Log::info('Sending OTP', ['email' => $email, 'otp' => $otp]);

        session(['guest_otp' => $otp, 'guest_email' => $email]);

        try {
            Mail::to($email)->send(new GuestOtpMail($otp, $name));
            Log::info('OTP sent successfully');
            return response()->json(['success' => true, 'email' => $email]);
        } catch (\Exception $e) {
            Log::error('Error sending OTP: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to send OTP.'], 500);
        }
    }

    public function verifyOtpForm(Request $request)
    {
        return view('frontend.book.guest_verify_otp', ['email' => $request->query('email')]);
    }

    // public function verifyOtp(Request $request)
    // {
    //     $otp = $request->input('otp');
    //     if ($otp == session('guest_otp')) {
    //         // OTP verified; proceed to payment
    //         session()->forget(['guest_otp', 'guest_email']);
    //         return view('frontend.book.guest_payment');
    //     } else {
    //         return back()->withErrors(['otp' => 'Invalid OTP.']);
    //     }
    // }

    public function verifyOtp(Request $request)
{
    $otp = $request->input('otp');
    if ($otp == session('guest_otp')) {
        // OTP verified; proceed to payment
        session()->forget('guest_otp'); // Remove OTP but retain email and booking details

        // Assume `roomDetails` and `totalPrice` are stored in the session during the room reservation step
        $roomDetails = session('room_details'); // Replace with actual data storage logic
        $totalPrice = session('total_price');   // Replace with actual data storage logic

        return view('frontend.book.guest_payment', [
            'email' => session('guest_email'),
            'roomDetails' => $roomDetails,
            'totalPrice' => $totalPrice,
        ]);
    } else {
        return back()->withErrors(['otp' => 'Invalid OTP.']);
    }
}

}
