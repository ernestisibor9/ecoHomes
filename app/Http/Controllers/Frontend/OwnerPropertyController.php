<?php

namespace App\Http\Controllers\Frontend;

use App\Events\PropertyAdded;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SellMyProperty;
use App\Models\UserProgress;
use Carbon\Carbon;
use App\Mail\SellerMail;
use App\Models\Consent;
use App\Models\Message;
use Haruncpi\LaravelIdGenerator\IdGenerator;

use Illuminate\Support\Facades\Mail;
use Pusher\Pusher;

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
        // Validate inputs
        $validator = $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'email' => 'required|email|unique:sell_my_properties,email',
            'phone' => 'required|numeric|regex:/^\+?[0-9]{10,15}$/', // Allow + and 10-15 digits
            'property_id' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'amenities' => 'required',
            'address' => 'required|string|max:255',
            'multi_img' => 'required|array',
            'multi_img.*' => 'image|mimes:jpeg,png,jpg,gif|max:1048',
            'video' => 'nullable|file|mimetypes:video/mp4,video/mkv,video/avi|max:51200',
            'description' => ['required', function ($attribute, $value, $fail) {
                $wordCount = str_word_count(strip_tags($value));
                if ($wordCount < 32) {
                    $fail("The $attribute must contain at least 100 words.");
                }
            }],
        ]);

        // Id Generator
        $reference_no = IdGenerator::generate([
            'table' => 'sell_my_properties',
            'field' => 'reference_no',
            'length' => 8,
            'prefix' => 'SELL',
        ]);

        // Process video file if uploaded
        $save_video = null; // Default to null
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $filename = time() . '.' . $video->getClientOriginalName();
            $video->move(public_path('upload/property_video/'), $filename);
            $save_video = 'upload/property_video/' . $filename;
        }

        // Process images
        $image_urls = [];
        if ($request->file('multi_img')) {
            $images = $request->file('multi_img');
            foreach ($images as $img) {
                $filename = date('YmdHi') . '_' . $img->getClientOriginalName();
                $img->move(public_path('upload/sell_property/'), $filename);
                $image_urls[] = 'upload/sell_property/' . $filename;
            }
        }

        // Convert images array to JSON or comma-separated string for storage
        $images_json = json_encode($image_urls);

        // Store property information in the database
        SellMyProperty::create([
            'user_id' => auth()->id(),
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'property_id' => $request->property_id,
            'address' => $request->address,
            'phone' => $request->phone,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'postal_code' => $request->postal_code,
            'reference_no' => $reference_no,
            'description' => $request->description,
            'amenities' => json_encode(array_map('trim', explode(',', $request->amenities))),
            'multi_img' => $images_json,
            'video' => $save_video, // Save the video path or null
            'status' => 'pending',
            'created_at' => Carbon::now(),
        ]);

        // Update user progress
        UserProgress::updateOrCreate(
            ['user_id' => auth()->id()],
            ['current_step' => 'step1', 'status' => 'pending']
        );

        // Send email notification
        try {
            Mail::to($request->email)->send(new SellerMail([
                'Subject' => 'Thank you for choosing EcoHomes as your trusted property platform.<br/>',
                'Message' => 'Your submission is pending approval. <br/> One of our expert will reach out to you soon.',
            ]));
        } catch (\Exception $e) {
            // Log error for debugging purposes
            return redirect()->back()->with([
                'message' => 'Failed to send email notification. Please try again later.',
                'alert-type' => 'error',
            ]);
        }


        $options = [
            'cluster' => env('PUSHER_APP_CLUSTER', 'eu'),
            'useTLS' => true,
        ];

        // $pusher = new Pusher(
        //     env('PUSHER_APP_KEY'),
        //     env('PUSHER_APP_SECRET'),
        //     env('PUSHER_APP_ID'),
        //     $options
        // );

        $pusher = new Pusher(
            '01d01f2b254eac705136',
            '7107f16d49a2ea763ef4',
            '1903241',
            $options
        );

        $data = [
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => 'New property added by ' . auth()->user()->name,
        ];

        $pusher->trigger('my-channel', 'my-event', $data);

        event(new PropertyAdded($data));

        // Mark form as completed in session
        session(['form_completed' => true]);

        return redirect()->route('status.page')->with([
            'message' => 'Property successfully submitted. We will contact you soon.',
            'alert-type' => 'success',
        ]);
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

    // upload Property
    public function uploadProperty()
    {
        return view('frontend.dashboard.upload.upload_property_doc');
    }
    // uploadProperty
    public function storeUploadProperty(Request $request)
    {
        $request->validate([
            'property_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('property_image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('upload/property_image/'), $filename);

        return response()->json(['path' => 'upload/property_image/' . $filename]);
    }

    // termsConditions
    public function termsConditions()
    {
        return view('frontend.terms_conditions.terms_conditions');
    }
    // Agree
    public function agreePage()
{
    return view('frontend.terms_conditions.consent'); // Replace 'agree' with the name of your Blade view.
}
// storeConsent
public function storeConsent(Request $request)
{
    // Validate the consent form inputs
    $request->validate([
        'consent_pdf' => 'required|mimes:pdf|max:1048',
    ]);
    // Process the consent PDF file
    $pdfPath = $request->file('consent_pdf');
        $filename = date('YmdHi') . $pdfPath->getClientOriginalName();
        $pdfPath->move(public_path('upload/conse'), $filename);

    // Store the consent information in the database
    Consent::create([
        'user_id' => auth()->id(),
        'consent_pdf' => $filename, // Replace 1 with the value that corresponds to 'accepted' in your database
    ]);

        // Update the UserProgress table
        $userProgress = UserProgress::where('user_id', auth()->id())->first();

        if ($userProgress) {
            $userProgress->current_step = 'step3'; // Update to the appropriate step
            $userProgress->save();
        } else {
            // If no record exists, create a new one
            // UserProgress::create([
            //     'user_id' => auth()->id(),
            //     'current_step' => 'step2', // Set the appropriate step
            // ]);
        }

    $notification = array(
        'message' => 'You have successfully uploaded the consent form. We will get in touch with you',
        'alert-type' => 'success',
    );
    return redirect()->route('dashboard')->with($notification);
}

}
