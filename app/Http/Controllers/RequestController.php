<?php

namespace App\Http\Controllers;

use App\Models\Country;

use App\Models\RequestProperty;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RequestController extends Controller
{
    // requestProperty
    public function requestProperty(){
        $countries = Country::get();
        return view('frontend.request.request_property', compact('countries'));
    }
    //


    public function storeRequestProperty(Request $request)
    {
        // Validate the request
        try {
            $validatedData = $request->validate([
                // 'ptype_id' => 'required|integer|exists:property_types,id',
                'property_type' => 'required|string',
                'property_status' => 'required|string',
                'bedroom' => 'nullable|numeric',
                'budget' => 'required|numeric',
                'phone' => 'required|numeric',
                'person' => 'required|string',
                'name' => 'required|string',
                'email' => 'required|string',
                'country_id' => 'required|string',
                'comment' => 'required|string|max:255',
            ]);

            // Insert property details
            RequestProperty::insert([
                'property_type' => $request->property_type,
                'property_status' => $request->property_status,
                'bedroom' => $request->bedroom,
                'budget' => $request->budget,
                'phone' => $request->phone,
                'person' => $request->person,
                'name' => $request->name,
                'email' => $request->email,
                'comment' => $request->comment,
                'postal_code' => $request->postal_code,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'created_at' => Carbon::now(),
            ]);

            // Notification
            // $notification = [
            //     'message' => 'Property Inserted Successfully',
            //     'alert-type' => 'success'
            // ];

            // return redirect()->back()->with($notification);
            return redirect()->back()->with('success', 'Request Submitted Successfully');
        } catch (\Exception $e) {
            Log::error('Exception occurred while storing property:', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
