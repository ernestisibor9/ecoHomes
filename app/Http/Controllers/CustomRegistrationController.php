<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;

class CustomRegistrationController extends Controller
{
    //
    /**
     * Show the registration form.
     */
    public function create()
    {
        return view('auth.custom-register');
    }

    //
    public function store(Request $request)
    {
        // Validate the registration fields (not OTP here)
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        // Generate OTP and set expiry time (e.g., 5 minutes)
        $otp = rand(100000, 999999);
        $otpExpiresAt = Carbon::now()->addMinutes(10);

        // Store OTP and expiry time in the user record
        $user->otp = $otp;
        $user->otp_expires_at = $otpExpiresAt;
        $user->save();

        // Send OTP via email
        try {
            Mail::to($user->email)->send(new \App\Mail\OtpMail($otp));
        } catch (\Exception $e) {
            Log::error("Email sending failed: " . $e->getMessage());
        }


        // Send OTP to the user via SMS or email
        $this->sendOtpSms($user->phone, $otp);

        // Redirect the user to the OTP input page
        return redirect()->route('otp.input')->with('info', 'Please check your phone for the OTP.');
    }


    private function sendOtpSms(string $phone, int $otp): void
    {
        // Retrieve Twilio credentials from the environment
        $twilioSid = env('TWILIO_SID');
        $twilioAuthToken = env('TWILIO_AUTH_TOKEN');
        $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');

        // Create a new Twilio client
        $twilio = new \Twilio\Rest\Client($twilioSid, $twilioAuthToken);

        // Send the SMS
        $twilio->messages->create($phone, [
            'from' => $twilioPhoneNumber,
            'body' => "Your OTP code is: $otp",
        ]);
    }
}
