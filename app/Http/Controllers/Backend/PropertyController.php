<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\City;
use App\Models\Country;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\SellMyProperty;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PropertyController extends Controller
{
    // AddProperty
    public function AddProperty()
    {
        $countries = Country::get();
        $propertyTypes = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $sellers = SellMyProperty::orderBy('firstname', 'ASC')->get();
        return view('admin.backend.property.add_property', compact('propertyTypes', 'amenities', 'sellers', 'countries'));
    }
    // AllProperty
    public function AllProperty()
    {
        $properties = Property::latest()->get();
        return view('admin.backend.property.all_property', compact('properties'));
    }
    // StoreProperty
    public function StoreProperty(Request $request)
    {
        // Validate the request
        try {
            $validatedData = $request->validate([
                'ptype_id' => 'required|integer|exists:property_types,id',
                'property_name' => 'required|string|max:255',
                'property_status' => 'required|string|in:book,rent,buy,lease', // Adjust based on your statuses
                'short_desc' => 'required|string|max:500',
                'long_desc' => 'required|string',
                'property_video' => 'nullable',
                'address' => 'required|string|max:255',
                'property_thumbnail' => 'required|image|max:1024|mimes:jpg,jpeg,png,gif',
                'multi_img.*' => 'required|image|max:1024|mimes:jpg,jpeg,png,gif',
            ]);

            $amenities = implode(',', $request->amenities_id); // Convert amenities array to string

            // Determine the prefix based on property_status
            $propertyStatus = $request->property_status;
            $prefix = match ($propertyStatus) {
                'buy' => 'BUY',
                'lease' => 'LEA',
                'rent' => 'REN',
                'book' => 'BOO',
                default => ''
            };

            // Generate the property code with the dynamic prefix
            $pcode = IdGenerator::generate([
                'table' => 'properties',
                'field' => 'property_code',
                'length' => 7, // Adjust length for the prefix + number
                'prefix' => $prefix
            ]);

            // Calculate fees if price_per_night is provided
            $cleaning_fee = $eco_home_service_fee = 0;
            if ($request->price_per_night) {
                $cleaning_fee = 0.05 * $request->price_per_night;
                $eco_home_service_fee = 0.10 * $request->price_per_night;
            }

            // Save property thumbnail
            $image = $request->file('property_thumbnail');
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('upload/property/thumbnail/'), $filename);
            $save_url = 'upload/property/thumbnail/' . $filename;

            // Insert property details
            $property_id = Property::insertGetId([
                'ptype_id' => $request->ptype_id,
                'amenities_id' => $amenities,
                'property_name' => $request->property_name,
                'property_slug' => Str::slug($request->property_name),
                'property_code' => $pcode,
                'property_status' => $request->property_status,
                'price' => $request->price,
                'price_per_night' => $request->price_per_night,
                'guest_capacity' => $request->guest_capacity,
                'cleaning_fee' => $cleaning_fee,
                'eco_home_service_fee' => $eco_home_service_fee,
                'maximum_price' => $request->price,
                'short_description' => $request->short_desc,
                'long_description' => $request->long_desc,
                'bedrooms' => $request->bedrooms,
                'bathrooms' => $request->bathrooms,
                'garage' => $request->garage,
                'property_video' => $request->property_video,
                'seller_id' => $request->seller_id,
                'verification_status' => $request->verification_status,
                'address' => $request->address,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'featured' => $request->featured,
                'hot' => $request->hot,
                'status' => 1,
                'property_thumbnail' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            // Handle multiple images
            foreach ($request->file('multi_img') as $img) {
                $filename2 = date('YmdHi') . $img->getClientOriginalName();
                $img->move(public_path('upload/property/multi_images/'), $filename2);
                $save_url2 = 'upload/property/multi_images/' . $filename2;

                MultiImage::insert([
                    'property_id' => $property_id,
                    'photo_name' => $save_url2,
                    'created_at' => Carbon::now()
                ]);
            }

            // Notification
            $notification = [
                'message' => 'Property Inserted Successfully',
                'alert-type' => 'success'
            ];
            return redirect()->route('all.property')->with($notification);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Edit Property
    public function EditProperty($id)
    {
        $property = Property::findOrFail($id);

        $type = $property->amenities_id;
        $property_amen = explode(',', $type);

        $multiImages = MultiImage::where('property_id', $id)->get();

        $amenities = Amenities::latest()->get();
        $propertyTypes = PropertyType::latest()->get();

        return view('admin.backend.property.edit_property', compact('property', 'multiImages', 'propertyTypes', 'amenities', 'property_amen'));
    }
    // update.property
    public function UpdateProperty(Request $request)
{
    // Validate the request
    $validatedData = $request->validate([
        'ptype_id' => 'nullable|integer|exists:property_types,id',
        'property_name' => 'nullable|string|max:255',
        'property_status' => 'nullable|string|in:book,rent,buy,lease', // Adjust based on your statuses
        'price' => 'nullable|numeric|min:0',
        'price_per_night' => 'nullable|numeric|min:0',
        'cleaning_fees' => 'nullable|numeric|min:0',
        'eco_home_service_fee' => 'nullable|numeric|min:0',
        'short_desc' => 'nullable|string|max:500',
        'long_desc' => 'nullable|string',
        'bedrooms' => 'nullable|integer|min:0',
        'bathrooms' => 'nullable|integer|min:0',
        'garage' => 'nullable|integer|min:0',
        'property_video' => 'nullable',
        'address' => 'nullable|string|max:255',
        'featured' => 'nullable',
        'hot' => 'nullable',
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
        'ptype_id' => $request->ptype_id,
        // 'amenities_id' => $amenities, // Uncomment and set if amenities are being updated
        'property_name' => $request->property_name,
        'property_slug' => $request->property_name ? Str::slug($request->property_name) : null,
        'property_status' => $request->property_status,
        'price' => $request->price,
        'price_per_night' => $request->price_per_night,
        'cleaning_fee' => $cleaningFee,
        'eco_home_service_fee' => $ecoHomeServiceFee,
        'short_description' => $request->short_desc,
        'long_description' => $request->long_desc,
        'bedrooms' => $request->bedrooms,
        'bathrooms' => $request->bathrooms,
        'garage' => $request->garage,
        'property_video' => $request->property_video,
        'address' => $request->address,
        'featured' => $request->featured,
        'hot' => $request->hot,
        'updated_at' => Carbon::now(),
    ]);

    // Notification
    $notification = [
        'message' => 'Property Updated Successfully',
        'alert-type' => 'success',
    ];

    return redirect()->route('all.property')->with($notification);
}

    // UpdatePropertyThumbnail
    public function UpdatePropertyThumbnail(Request $request)
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
            'message' => 'Property Thumbnail Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // UpdatePropertyMultiImg
    public function UpdatePropertyMultiImg(Request $request)
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
    // PropertyMultiDelete
    public function PropertyMultiDelete($id)
    {
        $oldImg = MultiImage::findOrFail($id);
        unlink($oldImg->photo_name);

        MultiImage::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Multiple Images Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // PropertyDelete
    public function PropertyDelete($id)
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
            'message' => 'Property Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.property')->with($notification);
    }
    // DetailsProperty
    public function DetailsProperty($id)
    {
        $property = Property::findOrFail($id);

        $type = $property->amenities_id;
        $property_amen = explode(',', $type);

        $multiImages = MultiImage::where('property_id', $id)->get();

        $amenities = Amenities::latest()->get();
        $propertyTypes = PropertyType::latest()->get();

        return view('admin.backend.property.details_property', compact('property', 'multiImages', 'propertyTypes', 'amenities', 'property_amen'));
    }
    // Change Status
    public function ChangeStatus($id)
    {
        $statusId = Property::findOrFail($id);

        if ($statusId->status === '0') {
            $statusId->status = '1';
        } else {
            $statusId->status = '0';
        }
        $statusId->save();

        $notification = array(
            'message' => 'Status updated to successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
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
}
