<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\CoverPhotoShortlet;
use App\Models\Facility;
use App\Models\FacilityShortlet;
use App\Models\MultiPhotoShortlet;
use App\Models\Room;
use App\Models\RoomShortlet;
use App\Models\Shortlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShortletController extends Controller
{
    //
        // Number of steps in the Shortlet creation process
        protected $steps = [
            'Step 1: Create Shortlet',
            'Step 2: Add Facilities',
            'Step 3: Add Rooms',
            'Step 4: Add Photos',
            'Step 5: Complete',
        ];

        // Step 1: Create Shortlet
        public function createStep1()
        {
            $countries = Country::get();
            $currentStep = 1;

            $notification = array(
                'message' => 'Please login to list your properties',
                'alert-type' => 'warning',
            );

            if (Auth::check()) {
                return view('frontend.shortlet.create', [
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
                'shortlet_name' => 'required|string|max:255',
                'address' => 'required|string|max:500',
                'postal_code' => 'nullable|string|max:20',
                'zip_code' => 'nullable|string|max:20',
                'description' => 'nullable|string',
                'channel_manager' => 'nullable|string',
                'number_of_shortlet' => 'nullable',
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

            // Create the Shortlet
            $shortlet = Shortlet::create($data);

            // Redirect to the facilities step
            return redirect()->route('shortlet.facilities', ['Shortlet' => $shortlet->id]);
        }


        // Step 2: Add Facilities
        public function createStep2($shortletId)
        {
            // Eager load the facilities relationship
            $shortlet = Shortlet::with('facilities')->findOrFail($shortletId);
            $facilities = FacilityShortlet::all();

            $currentStep = 2;

            return view('frontend.shortlet.facilities', [
                'shortlet' => $shortlet,
                'facilities' => $facilities,
                'steps' => $this->steps,
                'current' => $currentStep,
            ]);
        }

        public function postStep2(Request $request, $shortletId)
        {
            // Validate that 'facilities' is required and must be an array
            $request->validate([
                'facilities' => 'required|array',
            ]);

            $shortlet = Shortlet::findOrFail($shortletId); // Find the Shortlet or fail

            // Sync the selected facilities with the Shortlet
            // This will insert/update records in the pivot table 'facility_Shortlet'
            $shortlet->facilities()->sync($request->facilities);

            // Redirect to the next step (e.g., room creation)
            return redirect()->route('shortlet.rooms', ['shortlet' => $shortlet->id]);
        }

        // Step 3: Add Rooms
        public function createStep3($shortletId)
        {
            $shortlet = Shortlet::findOrFail($shortletId);
            $currentStep = 3;

            return view('frontend.shortlet.rooms', [
                'shortlet' => $shortlet,
                'steps' => $this->steps,
                'current' => $currentStep
            ]);
        }

        public function postStep3(Request $request, $shortletId)
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

            $shortlet = Shortlet::findOrFail($shortletId);

            // $price = 0.15 * $request->price_per_night;

            foreach ($request->rooms as $room) {
                RoomShortlet::create([
                    'shortlet_id' => $shortlet->id,
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

            return redirect()->route('shortlet.photos', ['shortlet' => $shortlet->id]);
        }


        // Step 4: Photos
        public function createStep4($shortletId)
        {
            $shortlet = Shortlet::findOrFail($shortletId);
            $rooms = RoomShortlet::where('shortlet_id', $shortletId)->get();
            $room = $rooms->first(); // Get the first room

            $currentStep = 4;

            if (!$room) {
                return redirect()->route('Shortlet.rooms', ['shortlet' => $shortletId])
                    ->with('error', 'Please add a room before uploading photos.');
            }

            return view('frontend.shortlet.photos', [
                'shortlet' => $shortlet,
                'rooms' => $rooms,
                'room' => $room,
                'steps' => $this->steps,
                'current' => $currentStep,
            ]);
        }


        public function postStep4(Request $request, $shortletId, $roomId)
        {
            $shortlet = Shortlet::findOrFail($shortletId);
            $room = RoomShortlet::findOrFail($roomId);

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
                    CoverPhotoShortlet::create([
                        'Shortlet_id' => $shortletId,
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
                        MultiPhotoShortlet::create([
                            'Shortlet_id' => $shortletId,
                            'room_id' => $roomId, // Assuming you have room_id available in the request
                            'multi_photo_name' => $save_url2, // Save the file path
                        ]);
                    }
                }

                return redirect()->route('shortlet.complete', ['shortlet' => $shortletId]);
            }

            return view('frontend.shortlet.photos', [
                'shortlet' => $shortlet,
                'steps' => $this->steps,
                'current' => $currentStep
            ]);
        }

        // // Step 4: Complete
        public function complete($ShortletId)
        {
            $Shortlet = Shortlet::findOrFail($ShortletId);
            $currentStep = 5;

            return view('frontend.Shortlet.complete', [
                'Shortlet' => $Shortlet,
                'steps' => $this->steps,
                'current' => $currentStep
            ]);
        }

        // View Shortlet
        public function viewShortlet($ShortletId)
        {
            $Shortlet = Shortlet::with(['facilities', 'rooms'])->findOrFail($ShortletId);
            $rooms = Room::where('Shortlet_id', $ShortletId)->get();
            $room = $rooms->first(); // Get the first room
           // dd($room);
            return view('frontend.Shortlet.view_Shortlet', compact('Shortlet', 'room'));
        }
}
