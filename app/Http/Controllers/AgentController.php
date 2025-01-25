<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use App\Models\MultiImage;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use GeoIp2\Database\Reader;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client; // For making API requests
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class AgentController extends Controller
{
    //
    public function AgentDashboard()
    {
        return view('frontend.agent.index');
    }
    public function AgentLogin()
    {
        return view('frontend.agent.agent_login');
    }
    public function AgentRegister()
    {
        return view('frontend.agent.agent_register');
    }
    // public function AgentStoreRegister(Request $request)
    // {
    //     $user = User::create([
    //         'name' => $request->name,
    //         'phone' => $request->phone,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'role' => 'agent',
    //         'status' => '1',
    //     ]);
    //     event(new Registered($user));

    //     Auth::login($user);

    //     return redirect(RouteServiceProvider::AGENT);
    //     //return view('auth.login');
    // }
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
    public function AgentManageRoom()
    {
        $id = Auth::user()->id;
        $rooms = Property::latest()->where('hotel_owner', $id)->paginate(12);
        return view('frontend.agent.all_rooms', compact('rooms'));
    }
    public function AgentDetailsRoom($id)
    {
        // Attempt to fetch the property from both tables
        $property = Property::find($id);

        $amenities = $property->amenities_id; // Get amenities_id
        $property_amen = explode(',', $amenities);

        // Initialize variables
        $multiImage = [];
        $currency = 'NGN'; // Default currency set to NGN
        $exchangeRate = 1.0; // Default exchange rate

        // Fetch user's IP and location details
        $ip = request()->ip(); // Get user IP address

        // Handle local IP (127.0.0.1 or ::1) or users from Nigeria
        if ($ip == '127.0.0.1' || $ip == '::1') {
            // For local development, assume Nigeria
            return $this->handleLocalRequest($property, $currency, $exchangeRate);
        }

        try {
            // Path to the GeoLite2 database
            $reader = new Reader(storage_path('geoip/GeoLite2-City.mmdb'));
            $record = $reader->city($ip);

            // Retrieve country name and determine if the user is in Nigeria
            $country = $record->country->name ?? 'Unknown';

            if ($country === 'Nigeria') {
                $currency = 'NGN';
                $exchangeRate = 1.0; // No conversion needed for Nigeria
            } else {
                // Fetch the currency and exchange rate for other countries
                $currency = $this->getCurrencyForCountry($country);
                $exchangeRate = $this->fetchExchangeRate2('USD', $currency); // Convert from USD to target currency
            }
        } catch (\Exception $e) {
            // Log the error and use default currency
            Log::error('GeoLite2 Error: ' . $e->getMessage());
        }

        $multiImage = MultiImage::where('property_id', $id)->get();

        return view('frontend.agent.agent_room_details', compact(
            'property',
            'multiImage',
            'property_amen',
            'currency',
            'exchangeRate' // Pass exchange rate to the view
        ));

        abort(404, 'Property not found');
    }

    private function fetchExchangeRate2($baseCurrency, $targetCurrency)
    {
        $cacheKey = "exchange_rate_{$baseCurrency}_{$targetCurrency}";

        // Check cache first
        return Cache::remember($cacheKey, 3600, function () use ($baseCurrency, $targetCurrency) {
            try {
                $client = new Client();
                $response = $client->get('https://v6.exchangerate-api.com/v6/4a33dde88ef89e91f1ee13a8/latest/' . $baseCurrency);
                $data = json_decode($response->getBody(), true);

                return $data['conversion_rates'][$targetCurrency] ?? 1.0; // Default to 1.0 if not found
            } catch (\Exception $e) {
                Log::error('Exchange Rate API Error: ' . $e->getMessage());
                return 1.0; // Default exchange rate in case of error
            }
        });
    }

    // Handle local development and Nigeria-specific requests
    public function handleLocalRequest($property, $currency, $exchangeRate)
    {
        $currency = 'NGN'; // Always use NGN for local development or Nigeria
        $exchangeRate = 1.0; // No conversion for NGN

        $amenities = $property->amenities_id; // Get amenities_id
        $property_amen = explode(',', $amenities);

        $multiImage = MultiImage::where('property_id', $property->id)->get();
        return view('frontend.agent.agent_room_details', compact(
            'property',
            'multiImage',
            'currency',
            'exchangeRate',
            'property_amen'
        ));

        abort(404, 'Property not found');
    }

    // AgentEditRoom
    public function AgentEditRoom($id)
    {
        $property = Property::findOrFail($id);

        $type = $property->amenities_id;
        $property_amen = explode(',', $type);

        $multiImages = MultiImage::where('property_id', $id)->get();

        $amenities = Amenities::latest()->get();
        $propertyTypes = PropertyType::latest()->get();

        return view('frontend.agent.edit_room', compact('property', 'multiImages', 'propertyTypes', 'amenities', 'property_amen'));
    }
    // AgentUpdateRoom
    public function AgentUpdateRoom(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'ptype_id' => 'nullable|integer|exists:property_types,id',
            'property_name' => 'nullable|string|max:255',
            // 'property_status' => 'nullable|string|in:book,rent,buy,lease', // Adjust based on your statuses
            // 'price' => 'nullable|numeric|min:0',
            'price_per_night' => 'nullable|numeric|min:0',
            // 'cleaning_fees' => 'nullable|numeric|min:0',
            'eco_home_service_fee' => 'nullable|numeric|min:0',
            'short_desc' => 'nullable|string|max:500',
            'long_desc' => 'nullable|string',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            // 'garage' => 'nullable|integer|min:0',
            // 'property_video' => 'nullable',
            'address' => 'nullable|string|max:255',
            // 'featured' => 'nullable',
            // 'hot' => 'nullable',
            // 'hotel_owner' => 'nullable|string',
            'room_number' => 'nullable|integer',
            'room_size' => 'nullable|string',
        ]);

        $propertyId = $request->id;

        // Calculate additional fees if price_per_night is provided
        $cleaningFee = $ecoHomeServiceFee = null;
        if ($request->price_per_night) {
            $cleaningFee = 0.05 * $request->price_per_night;
            $ecoHomeServiceFee = 0.10 * $request->price_per_night;
        }

        // Update the property
        Property::findOrFail($propertyId)->update([
            // 'ptype_id' => $request->ptype_id,
            // 'amenities_id' => $amenities, // Uncomment and set if amenities are being updated
            'property_name' => $request->property_name,
            'property_slug' => $request->property_name ? Str::slug($request->property_name) : null,
            // 'property_status' => $request->property_status,
            // 'price' => $request->price,
            'price_per_night' => $request->price_per_night,
            'cleaning_fee' => $cleaningFee,
            'eco_home_service_fee' => $ecoHomeServiceFee,
            'short_description' => $request->short_desc,
            'long_description' => $request->long_desc,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            // 'garage' => $request->garage,
            // 'property_video' => $request->property_video,
            'address' => $request->address,
            // 'featured' => $request->featured,
            // 'hot' => $request->hot,
            'room_number' => $request->room_number,
            'room_size' => $request->room_size,
            'updated_at' => Carbon::now(),
        ]);

        // Notification
        $notification = [
            'message' => 'Room Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('manage.rooms')->with($notification);
    }

    // UpdatePropertyThumbnail
    public function UpdateRoomThumbnail(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'property_thumbnail' => 'nullable|image|max:1048|mimes:jpg,jpeg,png,gif',
            'multi_img.*' => 'nullable|image|max:1048|mimes:jpg,jpeg,png,gif', // For multiple images
        ]);
        $pro_id = $request->id;
        $oldImage = $request->old_img;

        $image = $request->file('property_thumbnail');
        $filename = date('YmdHi') . $image->getClientOriginalName();
        $image->move(public_path('upload/property/thumbnail/'), $filename);

        $save_url = 'upload/property/thumbnail/' . $filename;

        if (file_exists($oldImage)) {
            unlink($oldImage);
        }
        Property::findOrFail($pro_id)->update([
            'property_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Room Thumbnail Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // UpdatePropertyMultiImg
    public function UpdateRoomMultiImg(Request $request)
    {
        $validatedData = $request->validate([
            'property_thumbnail' => 'nullable|image|max:1048|mimes:jpg,jpeg,png,gif',
            'multi_img.*' => 'nullable|image|max:1048|mimes:jpg,jpeg,png,gif', // For multiple images
        ]);
        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img) {
            $imgDel = MultiImage::findOrFail($id);
            unlink($imgDel->photo_name);

            $filename = date('YmdHi') . $img->getClientOriginalName();
            $img->move(public_path('upload/property/multi_images/'), $filename);

            $save_url = 'upload/property/multi_images/' . $filename;

            MultiImage::where('id', $id)->update([
                'photo_name' => $save_url,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Multiple Images Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    // AgentDeleteRoom
    public function AgentDeleteRoom($id)
    {
        $property = Property::findOrFail($id);
        $oldImage = $property->property_thumbnail;

        if (file_exists($oldImage)) {
            unlink($oldImage);
        }

        $images = MultiImage::where('property_id', $id)->get();
        foreach ($images as $image) {
            unlink($image->photo_name);
            MultiImage::where('property_id', $id)->delete();
        }
        Property::findOrFail($id)->delete();


        $notification = array(
            'message' => 'Room Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // Change Status
    public function ChangeRoomStatus($id)
    {
        $statusId = Property::findOrFail($id);

        if ($statusId->is_available === '0') {
            $statusId->is_available  = '1';
        } else {
            $statusId->is_available  = '0';
        }
        $statusId->save();

        $notification = array(
            'message' => 'Status updated to successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    //
    public function AgentLogout(Request $request)
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
