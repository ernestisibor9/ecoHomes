<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\CoverPhoto;
use App\Models\Facilitis;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Facility;
use App\Models\FacilityHotel;
use App\Models\MultiPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    // Number of steps in the hotel creation process
    protected $steps = [
        'Step 1: Create Hotel',
        'Step 2: Add Facilities',
        'Step 3: Add Rooms',
        'Step 4: Add Photos',
        'Step 5: Complete',
    ];

    // Step 1: Create Hotel
    public function createStep1()
    {
        $countries = Country::get();
        $currentStep = 1;

        $notification = array(
            'message' => 'Please login to list your properties',
            'alert-type' => 'warning',
        );

        if (Auth::check()) {
            return view('frontend.hotel.create', [
                'countries' => $countries,
                'steps' => $this->steps,
                'current' => $currentStep
            ]);
        } else {
            return redirect()->route('login')->with($notification);
        }
    }

    public function postStep1(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Validate incoming data
        $data = $request->validate([
            'hotel_name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'postal_code' => 'nullable|string|max:20',
            'zip_code' => 'nullable|string|max:20',
            'description' => 'nullable|string',
            'channel_manager' => 'nullable|string',
            'number_of_hotels' => 'nullable',
            'children' => 'nullable|string',
            'pet' => 'nullable|string',
            'language' => 'nullable|string',
            'guest_facilities' => 'nullable|array', // Validate facilities as an array
            'guest_facilities.*' => 'string', // Validate each facility as a string
        ]);

        // Convert facilities array to a comma-separated string
        $data['guest_facilities'] = $request->has('guest_facilities') ? implode(',', $request->guest_facilities) : null;


        // Add the user_id to the data
        $data['user_id'] = $user->id;

        // Create the hotel
        $hotel = Hotel::create($data);

        // Redirect to the facilities step
        return redirect()->route('hotel.facilities', ['hotel' => $hotel->id]);
    }


    // Step 2: Add Facilities
    public function createStep2($hotelId)
    {
        // Eager load the facilities relationship
        $hotel = Hotel::with('facilities')->findOrFail($hotelId);
        $facilities = Facility::all();

        $currentStep = 2;

        return view('frontend.hotel.facilities', [
            'hotel' => $hotel,
            'facilities' => $facilities,
            'steps' => $this->steps,
            'current' => $currentStep,
        ]);
    }

    public function postStep2(Request $request, $hotelId)
    {
        // Validate that 'facilities' is required and must be an array
        $request->validate([
            'facilities' => 'required|array',
        ]);

        $hotel = Hotel::findOrFail($hotelId); // Find the hotel or fail

        // Sync the selected facilities with the hotel
        // This will insert/update records in the pivot table 'facility_hotel'
        $hotel->facilities()->sync($request->facilities);

        // Redirect to the next step (e.g., room creation)
        return redirect()->route('hotel.rooms', ['hotel' => $hotel->id]);
    }

    // Step 3: Add Rooms
    public function createStep3($hotelId)
    {
        $hotel = Hotel::findOrFail($hotelId);
        $currentStep = 3;

        return view('frontend.hotel.rooms', [
            'hotel' => $hotel,
            'steps' => $this->steps,
            'current' => $currentStep
        ]);
    }

    public function postStep3(Request $request, $hotelId)
    {
        $request->validate([
            'rooms' => 'required|array',
            'rooms.*.room_type' => 'required',
            'rooms.*.room_capacity' => 'required|integer',
            'guest_facilities' => 'nullable|array',
            'guest_facilities.*' => 'string',
            'bathroom_item' => 'required|string',
            'bed_type' => 'required|string',
            'smoking' => 'required|string',
            'bathroom_status' => 'required|string',
            'description' => 'required|string',
            'number_of_rooms' => 'required',
            'price_per_night' => 'required',
        ]);

        $hotel = Hotel::findOrFail($hotelId);

        // $price = 0.15 * $request->price_per_night;

        foreach ($request->rooms as $room) {
            Room::create([
                'hotel_id' => $hotel->id,
                'room_name' => $request->room_name,
                'number_of_guest' => $request->number_of_guest,
                'bathroom_item' => $request->bathroom_item,
                'smoking' => $request->smoking,
                'number_of_rooms' => $request->number_of_rooms,
                'price_per_night' => $request->price_per_night,
                'bathroom_status' => $request->bathroom_status,
                'bed_type' => $request->bed_type,
                'description' => $request->description,
                'room_type' => $room['room_type'],
                'room_capacity' => $room['room_capacity'],
                'guest_facilities' => $request->guest_facilities ? json_encode($request->guest_facilities) : null,
            ]);
        }

        return redirect()->route('hotel.photos', ['hotel' => $hotel->id]);
    }


    // Step 4: Photos
    public function createStep4($hotelId)
    {
        $hotel = Hotel::findOrFail($hotelId);
        $rooms = Room::where('hotel_id', $hotelId)->get();
        $room = $rooms->first(); // Get the first room

        $currentStep = 4;

        if (!$room) {
            return redirect()->route('hotel.rooms', ['hotel' => $hotelId])
                ->with('error', 'Please add a room before uploading photos.');
        }

        return view('frontend.hotel.photos', [
            'hotel' => $hotel,
            'rooms' => $rooms,
            'room' => $room,
            'steps' => $this->steps,
            'current' => $currentStep,
        ]);
    }


    public function postStep4(Request $request, $hotelId, $roomId)
    {
        $hotel = Hotel::findOrFail($hotelId);
        $room = Room::findOrFail($roomId);

        $currentStep = 4;

        // If the form is submitted (POST request)
        if ($request->isMethod('post')) {
            // Validate the uploaded files
            $request->validate([
                'photo_name' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'multi_photo_name' => 'nullable|array',
                'multi_photo_name.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Store the cover photo
            if ($request->hasFile('photo_name')) {
                $coverPhoto = $request->file('photo_name');
                // $coverPhotoPath = $coverPhoto->store('public/upload/cover_photos'); // Store in the correct directory

                $filename = date('YmdHi') . $coverPhoto->getClientOriginalName();
                $coverPhoto->move(public_path('upload/cover_photos/'), $filename);
                $save_url = 'upload/cover_photos/' . $filename;

                // Save the cover photo path in the database
                CoverPhoto::create([
                    'hotel_id' => $hotelId,
                    'room_id' => $roomId, // Assuming you have room_id available in the request
                    'photo_name' => $save_url, // Save the file path
                ]);
            }

            // Store the multiple photos
            if ($request->hasFile('multi_photo_name')) {
                foreach ($request->file('multi_photo_name') as $multiPhoto) {
                    //$multiPhotoPath = $multiPhoto->store('public/upload/multi_photos'); // Store in the correct directory

                    $filename2 = date('YmdHi') . $multiPhoto->getClientOriginalName();
                    $multiPhoto->move(public_path('upload/multi_photos/'), $filename2);
                    $save_url2 = 'upload/multi_photos/' . $filename2;

                    // Save the multiple photo path in the database
                    MultiPhoto::create([
                        'hotel_id' => $hotelId,
                        'room_id' => $roomId, // Assuming you have room_id available in the request
                        'multi_photo_name' => $save_url2, // Save the file path
                    ]);
                }
            }

            return redirect()->route('hotel.complete', ['hotel' => $hotelId]);
        }

        return view('frontend.hotel.photos', [
            'hotel' => $hotel,
            'steps' => $this->steps,
            'current' => $currentStep
        ]);
    }

    // // Step 4: Complete
    public function complete($hotelId)
    {
        $hotel = Hotel::findOrFail($hotelId);
        $currentStep = 5;

        return view('frontend.hotel.complete', [
            'hotel' => $hotel,
            'steps' => $this->steps,
            'current' => $currentStep
        ]);
    }

    // View Hotel
    public function viewHotel($hotelId)
    {
        $hotel = Hotel::with(['facilities', 'rooms'])->findOrFail($hotelId);
        $rooms = Room::where('hotel_id', $hotelId)->get();
        $room = $rooms->first(); // Get the first room
       // dd($room);
        return view('frontend.hotel.view_hotel', compact('hotel', 'room'));
    }
}
