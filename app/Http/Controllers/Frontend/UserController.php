<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\SellerMail;
use App\Models\Sellmyproperty;
use App\Models\SellMyProperty as ModelsSellMyProperty;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    // GetStarted
    public function GetStarted()
    {
        return view('frontend.get_started.get_started');
    }
    // SellMyProperty
    public function SellMyProperty()
    {
        return view('frontend.get_started.sell_my_property');
    }
    // StoreSellMyProperty
    public function StoreSellMyProperty(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'email' => 'required|email|unique:sell_my_properties,email',
            'phone' => 'required|numeric|digits_between:10,20',
            'country_id' => 'required',
            'state_id' => 'required',
            'multi_img' => 'required|array', // Ensure multi_img is an array of images
            'multi_img.*' => 'image|mimes:jpeg,png,jpg,gif|max:1048', // Validate each image if multiple
            'description' => 'required|string',
        ], [
            'multi_img.required' => 'Please upload at least one image.',
            'multi_img.array' => 'The images must be uploaded as an array.',
            'multi_img.*.image' => 'Each file must be an image.',
            'multi_img.*.mimes' => 'Each image must be a file of type: jpeg, png, jpg, gif.',
            'multi_img.*.max' => 'Each image must be less than 1MB.',
        ]);

        if ($request->file('multi_img')) {
            $images = $request->file('multi_img');

            foreach ($images as $img) {
                // Generate a unique file name
                $filename = date('YmdHi') . $img->getClientOriginalName();
                $img->move(public_path('upload/sell_property/'), $filename);

                // Construct the file URL
                $save_url = 'upload/sell_property/' . $filename;

                // Insert Data into Sell My Properties table
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

            $data = [
                'Subject' => 'Thank you for using our platform to sell your property.',
                'Message' => 'We appreciate your request to sell your property on our platform. '
            ];
            Mail::to([$request->email, 'ernestisibor9@gmail.com'])->send(new SellerMail($data));

            $notification = [
                'message' => 'Property Successfully Submitted. We will contact you soon',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);
        }
    }

}
