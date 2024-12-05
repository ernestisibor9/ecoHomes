<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use App\Models\SellMyProperty as ModelsSellMyProperty;
use App\Mail\SellerMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LocationController extends Controller
{
    // SellMyProperty
    public function SellMyProperty()
    {
        $countries = Country::get();
        return view('frontend.get_started.sell_my_property', compact('countries'));
    }
    //
    public function GetStatesLocation($countryId)
    {
        $states = State::where('country_id', $countryId)->get();
        return json_encode($states);
    }

    public function GetCitiesLocation($stateId)
    {
        $cities = City::where('state_id', $stateId)->get();
        return json_encode($cities);
    }
    // SellMyPropertyDetails
    public function SellMyPropertyDetails()
    {
        return view('frontend.get_started.sell_my_property_details');
    }
    // SellMyPropertyTrack
    // SellMyPropertyTrack
    public function SellMyPropertyTrack($step)
    {
        $countries = Country::get();
        $totalSteps = 4; // Set the total number of steps
        $currentStep = $step; // Get current step from the route

        $notification = array(
            'message' => 'Please login to sell properties',
            'alert-type' => 'warning',
        );
        if (Auth::check()) {
            return view("frontend.get_started.sell_my_property_track{$step}", compact('countries'), ['currentStep' => $currentStep]);
        } else {
            return redirect()->route('seller.login')->with($notification);
        }
    }

    // SubmitStep
    public function SubmitStep(Request $request, $step)
    {
        $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'email' => 'required|email|unique:sell_my_properties,email',
            'phone' => 'required|numeric|digits_between:10,20',
            'country_id' => 'required',
            'state_id' => 'required',
            'multi_img' => 'required|array',
            'multi_img.*' => 'image|mimes:jpeg,png,jpg,gif|max:1048',
            'video' => 'required|mimes:mp4,avi,mkv,mov,wmv|max:5048',
            'description' => 'required|min:100',
        ]);

        if ($request->file('multi_img')) {

            $images = $request->file('multi_img');
            foreach ($images as $img) {
                $filename = date('YmdHi') . $img->getClientOriginalName();
                $img->move(public_path('upload/sell_property/'), $filename);
                $save_url = 'upload/sell_property/' . $filename;

                // Calculate progress based on the current step
                $totalSteps = 4; // Total number of steps
                $progressPercentage = ($step / $totalSteps) * 100;

                // Video
                $video = $request->file('video');
                $filename = time() . '.' . $video->getClientOriginalName();
                $video->move(public_path('upload/sell_property/video/'), $filename);
                $save_video = 'upload/sell_property/video/' . $filename;

                ModelsSellMyProperty::create([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'country_id' => $request->country_id,
                    'state_id' => $request->state_id,
                    'city_id' => $request->city_id,
                    'postal_code' => $request->postal_code,
                    'description' => $request->description,
                    'multi_img' => $save_url,
                    'video' => $save_video,
                    'progress' => $progressPercentage, // Save progress
                    'created_at' => Carbon::now(),
                ]);
            }

            try {
                Mail::to([$request->email, 'ernestisibor9@gmail.com'])->send(new SellerMail([
                    'Subject' => 'Thank you for choosing EcoHomes as your trusted property platform.',
                    'Message' => 'One of our expert will reach out to you soon.'
                ]));
            } catch (\Exception $e) {
                // Log or handle the error
            }

            // Store a session variable indicating the form has been completed
            session(['form_completed' => true]);

            $notification = [
                'message' => 'Property Successfully Submitted. We will contact you soon',
                'alert-type' => 'success'
            ];

            // Determine the next step

            // Calculate progress
            $nextStep = $step + 1; // Increment step
            // $nextStep = min($nextStep, 4); // Ensure it doesn't go beyond the final step
            return redirect()->route('next.form.route', ['step' => $nextStep])->with($notification);
        } else {
            $notification = [
                'message' => 'Please upload at least one image',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }



    //Ajax
    // In YourController.php
    public function SubmitStep2(Request $request, $step)
    {
        // Validate the request data
        $request->validate([
            // Your validation rules here
        ]);

        // Handle the file upload or other form inputs if necessary
        if ($request->hasFile('file_input')) {
            // Handle the uploaded file or other inputs
        }

        // Calculate the next step (ensure you don't exceed the maximum number of steps)
        $nextStep = $step + 1;
        $nextStep = min($nextStep, 4); // Assuming 4 is the last step


        // Regular form submission if not AJAX
        return redirect()->route('next.form.route2', ['step' => $nextStep])->with('success', 'Form submitted successfully!');
    }

    // ReachMillionDetails
    public function ReachMillionDetails()
    {
        return view('frontend.get_started.reach_million_details');
    }

    // ExpertSolutionDetails
    public function ExpertSolutionDetails()
    {
        return view('frontend.get_started.expert_solution_details');
    }

    // SimpleProcessDetails
    public function SimpleProcessDetails()
    {
        return view('frontend.get_started.simple_process_details');
    }

    // BookMyPropertyDetails
    public function BookMyPropertyDetails()
    {
        return view('frontend.get_started.book_my_property_details');
    }
    // TrustedOwnerDetails
    public function TrustedOwnerDetails(){
        return view('frontend.get_started.trusted_owner_details');
    }
    // UnmatchedVarietyDetails
    public function UnmatchedVarietyDetails(){
        return view('frontend.get_started.unmatched_variety_details');
    }
    // SmartSearchDetails
    public function SmartSearchDetails(){
        return view('frontend.get_started.smart_search_details');
    }
}
