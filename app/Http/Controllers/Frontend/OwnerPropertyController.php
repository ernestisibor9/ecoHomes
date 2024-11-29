<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SellMyProperty;
use App\Models\UserProgress;
use Carbon\Carbon;
use App\Mail\SellerMail;
use Illuminate\Support\Facades\Mail;

class OwnerPropertyController extends Controller
{
    // Step 1: Property form
    public function showStep1Form()
    {
        $progress = UserProgress::where('user_id', auth()->id())->first();
        $countries = Country::get();
        $notification = array(
            'message' => 'Please login to sell properties',
            'alert-type' => 'warning',
        );
        if (Auth::check()) {
            return view('frontend.owner_property.step1', compact('countries', 'progress'));
        } else {
            return redirect()->route('login')->with($notification);
        }
    }
    public function showStep2Form()
    {
        $progress = UserProgress::where('user_id', auth()->id())->first();

    // Only set status to 'pending' if no status is already set (i.e., it's null)
    if ($progress && $progress->status === null) {
        $progress->status = 'pending';  // Set the status to 'pending' if it's null
        $progress->save();  // Save the status change to the database
    }

        $notification = array(
            'message' => 'Please login to sell properties',
            'alert-type' => 'warning',
        );
        if (Auth::check()) {
            return view('frontend.owner_property.step2', compact('progress'));
        } else {
            return redirect()->route('login')->with($notification);
        }
    }
    // Step 2: Property form
    // SubmitStep
    public function SubmitStep1(Request $request)
    {
        $progress = UserProgress::where('user_id', auth()->id())->first();
        $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'email' => 'required|email|unique:sell_my_properties,email',
            'phone' => 'required|numeric|digits_between:10,20',
            'country_id' => 'required',
            'state_id' => 'required',
            'multi_img' => 'required|array',
            'multi_img.*' => 'image|mimes:jpeg,png,jpg,gif|max:1048',
            // 'video' => 'required|mimes:mp4,avi,mkv,mov,wmv|max:6048',
            'description' => 'required|min:100',
        ]);

        if ($request->file('multi_img')) {

            $images = $request->file('multi_img');
            foreach ($images as $img) {
                $filename = date('YmdHi') . $img->getClientOriginalName();
                $img->move(public_path('upload/sell_property/'), $filename);
                $save_url = 'upload/sell_property/' . $filename;

                SellMyProperty::create([
                    'user_id' => auth()->id(),
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
                    // 'video' => $save_video,
                    'status' => 'pending',
                    'created_at' => Carbon::now(),
                ]);
                // Create user progress
                UserProgress::updateOrCreate(
                    ['user_id' => auth()->id()],
                    ['current_step' => 'step1', 'status' => 'pending']
                );
            }

            try {
                Mail::to([$request->email, 'ernestisibor9@gmail.com'])->send(new SellerMail([
                    'Subject' => 'Thank you for using our platform to sell your property.',
                    'Message' => 'Your submission is pending approval. We will contact you soon'
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

            return redirect()->route('status.page')->with($notification);
        } else {
            $notification = [
                'message' => 'Please upload at least one image',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }
    // Show user progress
    public function showStatusPage()
    {
        $progress = UserProgress::where('user_id', auth()->id())->first();

        $notification = array(
            'message' => 'Please login to sell properties',
            'alert-type' => 'warning',
        );
        if (Auth::check()) {
            return view('frontend.owner_property.status', compact('progress'));
        } else {
            return redirect()->route('login')->with($notification);
        }
    }
    // ShowStep3Form
    public function showStep3Form()
    {
        $progress = UserProgress::where('user_id', auth()->id())->first();
    // Only set status to 'pending' if no status is already set (i.e., it's null)
    if ($progress && $progress->status === null) {
        $progress->status = 'pending';  // Set the status to 'pending' if it's null
        $progress->save();  // Save the status change to the database
    }

        $notification = array(
            'message' => 'Please login to sell properties',
            'alert-type' => 'warning',
        );
        if (Auth::check()) {
            return view('frontend.owner_property.step3', compact('progress'));
        } else {
            return redirect()->route('login')->with($notification);
        }
    }
}
