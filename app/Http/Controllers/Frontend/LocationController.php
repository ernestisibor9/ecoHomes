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
    public function GetStates($countryId)
    {
        $states = State::where('country_id', $countryId)->get();
        return json_encode($states);
    }

    public function GetCities($stateId)
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

        return view("frontend.get_started.sell_my_property_track{$step}", compact('countries'), ['currentStep' => $currentStep]);
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
            'description' => 'required|string',
        ]);

        if ($request->file('multi_img')) {
            $images = $request->file('multi_img');
            foreach ($images as $img) {
                $filename = date('YmdHi') . $img->getClientOriginalName();
                $img->move(public_path('upload/sell_property/'), $filename);
                $save_url = 'upload/sell_property/' . $filename;

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
                    'created_at' => Carbon::now(),
                ]);
            }

            try {
                Mail::to([$request->email, 'ernestisibor9@gmail.com'])->send(new SellerMail([
                    'Subject' => 'Thank you for using our platform to sell your property.',
                    'Message' => 'We appreciate your request to sell your property on our platform.'
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
            $nextStep = $step + 1; // Increment step, or use custom logic as needed

            return redirect()->route('next.form.route', ['step' => $nextStep])->with($notification);
        }
    }
}
