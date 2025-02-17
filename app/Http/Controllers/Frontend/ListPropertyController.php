<?php

namespace App\Http\Controllers\Frontend;

// use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\ListProperty;
use App\Models\MultiPhotoProperty;
use Carbon\Carbon;
use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient as ClientImageAnnotatorClient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class ListPropertyController extends Controller
{
    // apartmentFlat
    public function apartmentFlat()
    {

        $notification = array(
            'message' => 'Please login to list your properties',
            'alert-type' => 'warning',
        );

        if (Auth::check()) {
            $countries = Country::get();
            return view('frontend.list_property.apartment_flat', compact('countries'));
        } else {
            return redirect()->route('login')->with($notification);
        }
    }
    //
    // StoreProperty
    public function storeApartmentFlat(Request $request)
    {
        // Validate the request
        try {
            $validatedData = $request->validate([
                // 'ptype_id' => 'required|integer|exists:property_types,id',
                'property_title' => 'required|string|max:255',
                'property_status' => 'required|string',
                'bedroom' => 'nullable|numeric',
                'bathroom' => 'nullable|numeric',
                'toilet' => 'nullable|numeric',
                'property_variant' => 'required',
                'owner_phone' => 'required|numeric',
                'owner_name' => 'required|string',
                'price' => 'nullable|numeric',
                'furnishing_status' => 'nullable|string',
                'season' => 'nullable|string',
                'size' => 'nullable|string',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'country_id' => 'required',
                'address' => 'required|string|max:255',
                'guest_facilities' => 'nullable|array', // Ensure it's an array
                'guest_facilities.*' => 'string|max:255', // Validate each facility
                'property_thumbnail' => 'required|image|max:3024|mimes:jpg,jpeg,png,gif',
                'multi_photo_name.*' => 'required|image|max:3024|mimes:jpg,jpeg,png,gif',
            ]);
            // Determine the prefix based on property_status
            $propertyStatus = $request->property_status;
            $prefix = match ($propertyStatus) {
                'sell' => 'SEL',
                'lease' => 'LEA',
                'rent' => 'REN',
                default => ''
            };

            // Generate the property code with the dynamic prefix
            $pcode = IdGenerator::generate([
                'table' => 'list_properties',
                'field' => 'property_code',
                'length' => 7, // Adjust length for the prefix + number
                'prefix' => $prefix
            ]);

            // Save property thumbnail
            $image = $request->file('property_thumbnail');
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('upload/property/thumbnail/'), $filename);
            $save_url = 'upload/property/thumbnail/' . $filename;

            // Insert property details
            $property_id = ListProperty::insertGetId([
                'user_id' => Auth::user()->id,
                'property_title' => $request->property_title,
                'property_status' => $request->property_status,
                'property_slug' => Str::slug($request->property_title),
                'property_type' => 'flat',
                'property_variant' => $request->property_variant,
                'postal_code' => $request->postal_code,
                'latitude' => $request->latitude ?? null,
                'longitude' => $request->longitude ?? null,
                'season'=>$request->season,

                'property_code' => $pcode,
                'bedroom' => $request->bedroom,
                'bathroom' => $request->bathroom,
                'toilet' => $request->toilet,
                'owner_phone' => $request->owner_phone,
                'owner_name' => $request->owner_name,
                'price' => $request->price,
                'description' => $request->description,
                'address' => $request->address,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'size' => $request->size,
                'furnishing_status' => $request->furnishing_status,
                'guest_facilities' => json_encode($request->guest_facilities), // Store as JSON
                'property_thumbnail' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            // Save property features

            // Handle multiple images
            foreach ($request->file('multi_photo_name') as $img) {
                $filename2 = date('YmdHi') . $img->getClientOriginalName();
                $img->move(public_path('upload/property/multi_images/'), $filename2);
                $save_url2 = 'upload/property/multi_images/' . $filename2;

                MultiPhotoProperty::insert([
                    'list_property_id' => $property_id,
                    'multi_photo_name' => $save_url2,
                    'created_at' => Carbon::now()
                ]);
            }

            // Notification
            // $notification = [
            //     'message' => 'Property Inserted Successfully',
            //     'alert-type' => 'success'
            // ];

            // return redirect()->back()->with($notification);
            return redirect()->back()->with('success', 'Property Inserted Successfully');
        } catch (\Exception $e) {
            Log::error('Exception occurred while storing property:', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }






    // apartmentHome
    public function apartmentHouse()
    {

        $notification = array(
            'message' => 'Please login to list your properties',
            'alert-type' => 'warning',
        );

        if (Auth::check()) {
            $countries = Country::get();
            return view('frontend.list_property.house', compact('countries'));
        } else {
            return redirect()->route('login')->with($notification);
        }
    }
    //
    // StoreProperty
    public function storeApartmentHouse(Request $request)
    {
        // Validate the request
        try {
            $validatedData = $request->validate([
                // 'ptype_id' => 'required|integer|exists:property_types,id',
                'property_title' => 'required|string|max:255',
                'property_status' => 'required|string',
                'bedroom' => 'nullable|numeric',
                'bathroom' => 'nullable|numeric',
                'toilet' => 'nullable|numeric',
                'property_variant' => 'required',
                'season' => 'nullable|string',
                'owner_phone' => 'required|numeric',
                'owner_name' => 'required|string',
                'price' => 'required|numeric',
                'furnishing_status' => 'nullable|string',
                'size' => 'nullable|string',
                'country_id' => 'required',
                'address' => 'required|string|max:255',
                'guest_facilities' => 'nullable|array', // Ensure it's an array
                'guest_facilities.*' => 'string|max:255', // Validate each facility
                'property_thumbnail' => 'required|image|max:3024|mimes:jpg,jpeg,png,gif',
                'multi_photo_name.*' => 'required|image|max:3024|mimes:jpg,jpeg,png,gif',
            ]);
            // Determine the prefix based on property_status
            $propertyStatus = $request->property_status;
            $prefix = match ($propertyStatus) {
                'sell' => 'SEL',
                'lease' => 'LEA',
                'rent' => 'REN',
                default => ''
            };

            // Generate the property code with the dynamic prefix
            $pcode = IdGenerator::generate([
                'table' => 'list_properties',
                'field' => 'property_code',
                'length' => 7, // Adjust length for the prefix + number
                'prefix' => $prefix
            ]);

            // Save property thumbnail
            $image = $request->file('property_thumbnail');
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('upload/property/thumbnail/'), $filename);
            $save_url = 'upload/property/thumbnail/' . $filename;

            // Insert property details
            $property_id = ListProperty::insertGetId([
                'user_id' => Auth::user()->id,
                'property_title' => $request->property_title,
                'property_status' => $request->property_status,
                'property_slug' => Str::slug($request->property_title),
                'property_type' => 'house',
                'property_variant' => $request->property_variant,
                'postal_code' => $request->postal_code,
                'season' => $request->season,

                'property_code' => $pcode,
                'bedroom' => $request->bedroom,
                'bathroom' => $request->bathroom,
                'toilet' => $request->toilet,
                'owner_phone' => $request->owner_phone,
                'owner_name' => $request->owner_name,
                'description' => $request->description,
                'address' => $request->address,
                'price' => $request->price,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'size' => $request->size,
                'furnishing_status' => $request->furnishing_status,
                'guest_facilities' => json_encode($request->guest_facilities), // Store as JSON
                'property_thumbnail' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            // Save property features

            // Handle multiple images
            foreach ($request->file('multi_photo_name') as $img) {
                $filename2 = date('YmdHi') . $img->getClientOriginalName();
                $img->move(public_path('upload/property/multi_images/'), $filename2);
                $save_url2 = 'upload/property/multi_images/' . $filename2;

                MultiPhotoProperty::insert([
                    'list_property_id' => $property_id,
                    'multi_photo_name' => $save_url2,
                    'created_at' => Carbon::now()
                ]);
            }

            // Notification
            // $notification = [
            //     'message' => 'Property Inserted Successfully',
            //     'alert-type' => 'success'
            // ];

            // return redirect()->back()->with($notification);
            return redirect()->back()->with('success', 'Property Inserted Successfully');
        } catch (\Exception $e) {
            Log::error('Exception occurred while storing property:', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }





    // Land
    public function landProperty()
    {

        $notification = array(
            'message' => 'Please login to list your properties',
            'alert-type' => 'warning',
        );

        if (Auth::check()) {
            $countries = Country::get();
            return view('frontend.list_property.land', compact('countries'));
        } else {
            return redirect()->route('login')->with($notification);
        }
    }
    //
    // StoreProperty
    public function storeLandProperty(Request $request)
    {
        // Validate the request
        try {
            $validatedData = $request->validate([
                // 'ptype_id' => 'required|integer|exists:property_types,id',
                'property_title' => 'required|string|max:255',
                'property_status' => 'required|string',
                'topography' => 'required|string',
                'road_access' => 'required|string',
                'fencing' => 'required|string',
                'drainage_system' => 'required|string',
                'flood_risk' => 'required|string',
                'property_variant' => 'required',
                'owner_phone' => 'required|numeric',
                'owner_name' => 'required|string',
                'price' => 'nullable|numeric',
                'size' => 'nullable|string',
                'country_id' => 'required',
                'address' => 'required|string|max:255',
                'guest_facilities' => 'nullable|array', // Ensure it's an array
                'guest_facilities.*' => 'string|max:255', // Validate each facility
                'property_thumbnail' => 'required|image|max:3024|mimes:jpg,jpeg,png,gif',
                'multi_photo_name.*' => 'required|image|max:3024|mimes:jpg,jpeg,png,gif',
            ]);
            // Determine the prefix based on property_status
            $propertyStatus = $request->property_status;
            $prefix = match ($propertyStatus) {
                'sell' => 'SEL',
                'lease' => 'LEA',
                'rent' => 'REN',
                default => ''
            };

            // Generate the property code with the dynamic prefix
            $pcode = IdGenerator::generate([
                'table' => 'list_properties',
                'field' => 'property_code',
                'length' => 7, // Adjust length for the prefix + number
                'prefix' => $prefix
            ]);

            // Save property thumbnail
            $image = $request->file('property_thumbnail');
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('upload/property/thumbnail/'), $filename);
            $save_url = 'upload/property/thumbnail/' . $filename;

            // Insert property details
            $property_id = ListProperty::insertGetId([
                'user_id' => Auth::user()->id,
                'property_title' => $request->property_title,
                'property_status' => $request->property_status,
                'property_slug' => Str::slug($request->property_title),
                'property_type' => 'land',
                'property_variant' => $request->property_variant,
                'postal_code' => $request->postal_code,

                'property_code' => $pcode,
                'topography' => $request->topography,
                'road_access' => $request->road_access,
                'fencing' => $request->fencing,
                'drainage_system' => $request->drainage_system,
                'flood_risk' => $request->flood_risk,
                'owner_phone' => $request->owner_phone,
                'owner_name' => $request->owner_name,
                'price' => $request->price,
                'description' => $request->description,
                'address' => $request->address,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'size' => $request->size,
                'guest_facilities' => json_encode($request->guest_facilities), // Store as JSON
                'property_thumbnail' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            // Save property features

            // Handle multiple images
            foreach ($request->file('multi_photo_name') as $img) {
                $filename2 = date('YmdHi') . $img->getClientOriginalName();
                $img->move(public_path('upload/property/multi_images/'), $filename2);
                $save_url2 = 'upload/property/multi_images/' . $filename2;

                MultiPhotoProperty::insert([
                    'list_property_id' => $property_id,
                    'multi_photo_name' => $save_url2,
                    'created_at' => Carbon::now()
                ]);
            }

            // Notification
            // $notification = [
            //     'message' => 'Property Inserted Successfully',
            //     'alert-type' => 'success'
            // ];

            // return redirect()->back()->with($notification);
            return redirect()->back()->with('success', 'Property Inserted Successfully');
        } catch (\Exception $e) {
            Log::error('Exception occurred while storing property:', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    // Commercial

    public function commercialProperty()
    {

        $notification = array(
            'message' => 'Please login to list your properties',
            'alert-type' => 'warning',
        );

        if (Auth::check()) {
            $countries = Country::get();
            return view('frontend.list_property.commercial', compact('countries'));
        } else {
            return redirect()->route('login')->with($notification);
        }
    }
    //
    // StoreProperty
    public function storecommercialProperty(Request $request)
    {
        // Validate the request
        try {
            $validatedData = $request->validate([
                // 'ptype_id' => 'required|integer|exists:property_types,id',
                'property_title' => 'required|string|max:255',
                'property_status' => 'required|string',
                'condition' => 'nullable|string',
                'floor' => 'nullable|numeric',
                'bathroom' => 'nullable|numeric',
                'toilet' => 'nullable|numeric',
                'property_variant' => 'required',
                'owner_phone' => 'required|numeric',
                'price' => 'nullable|numeric',
                'furnishing_status' => 'nullable|string',
                'size' => 'nullable|string',
                'country_id' => 'required',
                'address' => 'required|string|max:255',
                'guest_facilities' => 'nullable|array', // Ensure it's an array
                'guest_facilities.*' => 'string|max:255', // Validate each facility
                'property_thumbnail' => 'required|image|max:3024|mimes:jpg,jpeg,png,gif',
                'multi_photo_name.*' => 'required|image|max:3024|mimes:jpg,jpeg,png,gif',
            ]);
            // Determine the prefix based on property_status
            $propertyStatus = $request->property_status;
            $prefix = match ($propertyStatus) {
                'sell' => 'SEL',
                'lease' => 'LEA',
                'rent' => 'REN',
                default => ''
            };

            // Generate the property code with the dynamic prefix
            $pcode = IdGenerator::generate([
                'table' => 'list_properties',
                'field' => 'property_code',
                'length' => 7, // Adjust length for the prefix + number
                'prefix' => $prefix
            ]);

            // Save property thumbnail
            $image = $request->file('property_thumbnail');
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('upload/property/thumbnail/'), $filename);
            $save_url = 'upload/property/thumbnail/' . $filename;

            // Insert property details
            $property_id = ListProperty::insertGetId([
                'user_id' => Auth::user()->id,
                'property_title' => $request->property_title,
                'property_status' => $request->property_status,
                'property_slug' => Str::slug($request->property_title),
                'property_type' => 'commercial',
                'property_variant' => $request->property_variant,
                'postal_code' => $request->postal_code,
                'condition' => $request->condition,
                'floor' => $request->floor,

                'property_code' => $pcode,
                'bathroom' => $request->bathroom,
                'toilet' => $request->toilet,
                'owner_phone' => $request->owner_phone,
                'price' => $request->price ?? 0,
                'description' => $request->description,
                'address' => $request->address,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'size' => $request->size,
                'furnishing_status' => $request->furnishing_status,
                'guest_facilities' => json_encode($request->guest_facilities), // Store as JSON
                'property_thumbnail' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            // Save property features

            // Handle multiple images
            foreach ($request->file('multi_photo_name') as $img) {
                $filename2 = date('YmdHi') . $img->getClientOriginalName();
                $img->move(public_path('upload/property/multi_images/'), $filename2);
                $save_url2 = 'upload/property/multi_images/' . $filename2;

                MultiPhotoProperty::insert([
                    'list_property_id' => $property_id,
                    'multi_photo_name' => $save_url2,
                    'created_at' => Carbon::now()
                ]);
            }

            // Notification
            // $notification = [
            //     'message' => 'Property Inserted Successfully',
            //     'alert-type' => 'success'
            // ];

            // return redirect()->back()->with($notification);
            return redirect()->back()->with('success', 'Property Inserted Successfully');
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
