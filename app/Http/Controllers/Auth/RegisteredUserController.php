<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

            // Ensure the user is logged out
    Auth::logout();

        // Generate OTP
        $otp = rand(100000, 999999);
        $otpExpiresAt = Carbon::now()->addMinutes(10); // OTP expiration time

        dd($otp);
        dd($otpExpiresAt);
        exit();

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp' => $otp,
            'otp_expires_at' => $otpExpiresAt,
        ]);

        // Send OTP via email
        try {
            Mail::to($user->email)->send(new \App\Mail\OtpMail($otp));
        } catch (\Exception $e) {
            Log::error("Email sending failed: " . $e->getMessage());
        }

        // Send OTP via SMS using Twilio
        $this->sendOtpSms($user->phone, $otp);

        // Redirect to the OTP input page after successful registration
        // Keep the user logged out at this point
        return redirect()->route('otp.input', ['user' => $user->id]);
    }



    //
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
