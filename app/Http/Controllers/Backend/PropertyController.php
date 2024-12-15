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
        return view('admin.backend.property.add_property', compact('propertyTypes', 'amenities', 'countries'));
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
        // $request->validate([
        //     'property_thumbnail' => 'sometimes|image|max:2024|mimes:jpg,jpeg,png,gif',
        //     'photo_name' => 'sometimes|image|max:2024|mimes:jpg,jpeg,png,gif',
        // ]);

        $amen = $request->amenities_id;
        $amenities = implode(',', $amen); // Add a comma to separate it and convert to array to string

        $pcode = IdGenerator::generate(['table' => 'properties', 'field' =>
        'property_code', 'length' => 5, 'prefix' => 'PC']);


        // Without Imagick 700 x 800
        $image = $request->file('property_thumbnail');
        $filename = date('YmdHi') . $image->getClientOriginalName();
        $image->move(public_path('upload/property/thumbnail/'), $filename);

        $save_url = 'upload/property/thumbnail/' . $filename;

        $property_id = Property::insertGetId([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenities,
            'property_name' => $request->property_name,
            'property_slug' => Str::slug($request->property_name),
            'property_code' => $pcode,
            'property_status' => $request->property_status,
            'price' => $request->price,
            'maximum_price' => $request->price,
            'short_description' => $request->short_desc,
            'long_description' => $request->long_desc,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'property_video' => $request->property_video,

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

        // Multiple images
        $images = $request->file('multi_img');

        foreach ($images as $img1) {

            // Without Imagick 700 x 800
            // $image2 = $request->file($img1);
            $filename2 = date('YmdHi') . $img1->getClientOriginalName();
            $img1->move(public_path('upload/property/multi_images/'), $filename2);

            $save_url2 = 'upload/property/multi_images/' . $filename2;

            // Insert Data into Multi Img table
            MultiImage::insert([
                'property_id' => $property_id,
                'photo_name' => $save_url2,
                'created_at' => Carbon::now()
            ]);
        }

        // Facility
        // $facilities = Count($request->facility_name);
        // if($facilities != NULL) {
        //     for($i=0;$i<$facilities;$i++){
        //         $fcount = new Facility();
        //         $fcount->property_id = $property_id;
        //         $fcount->facility_name = $request->facility_name[$i];
        //         $fcount->save();
        //     }
        // }

        $notification = array(
            'message' => 'Property Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.property')->with($notification);
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
        $amen = $request->amenities_id;
        $amenities = implode(',', $amen); // Add a comma to separate it and convert to array to string

        $pid = $request->id;

        Property::findOrFail($pid)->update([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenities,
            'property_name' => $request->property_name,
            'property_slug' => Str::slug($request->property_name),

            'property_status' => $request->property_status,
            'price' => $request->price,
            'short_description' => $request->short_desc,
            'long_description' => $request->long_desc,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'property_video' => $request->property_video,

            'address' => $request->address,
            // 'city' => $request->city,
            // 'country' => $request->country,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Property Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.property')->with($notification);
    }
    // UpdatePropertyThumbnail
    public function UpdatePropertyThumbnail(Request $request)
    {
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
