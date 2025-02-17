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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'otp_delivery' => ['required', 'in:email,phone'], // Ensure user selects a valid option
        ]);

        // Generate OTP
        $otp = rand(100000, 999999);
        $otpExpiresAt = Carbon::now()->addMinutes(10); // OTP expiration time

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp' => $otp,
            'otp_expires_at' => $otpExpiresAt,
        ]);

        // Send OTP based on user selection
        if ($request->otp_delivery === 'email') {
            try {
                Mail::to($user->email)->send(new \App\Mail\OtpMail($otp));
            } catch (\Exception $e) {
                Log::error("Email sending failed: " . $e->getMessage());
            }
        } else {
            $this->sendOtpSms($user->phone, $otp);
        }

        // Redirect to the OTP input page after successful registration
        // return redirect()->route('otp.input', ['user' => $user->id]);
        return redirect()->route('otp.input', ['user' => $user->id, 'otp_delivery' => $request->otp_delivery]);

    }



    private function sendOtpSms(string $phone, int $otp): void
    {
        $twilioSid = env('TWILIO_SID');
        $twilioAuthToken = env('TWILIO_AUTH_TOKEN');
        $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');

        $twilio = new \Twilio\Rest\Client($twilioSid, $twilioAuthToken);

        $twilio->messages->create($phone, [
            'from' => $twilioPhoneNumber,
            'body' => "Your OTP code is: $otp",
        ]);
    }
}
