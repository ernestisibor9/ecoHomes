<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    //
    // Addamenities
    public function AddAmenities()
    {
        return view('admin.backend.amenities.add_amenities');
    }
    // Store amenities
    public function StoreAmenities(Request $request)
    {

        $request->validate([
            'amenities_name' => 'required|max:200',
        ]);

        // Insert into database
        Amenities::insert([
            'amenities_name' => $request->amenities_name,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => ' Amenities Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.amenities')->with($notification);
    }
    // All Property amenitiess
    public function AllAmenities()
    {
        $amenities = Amenities::latest()->get();
        return view('admin.backend.amenities.all_amenities', compact('amenities'));
    }
    // Edit Property amenities
    public function amenitiesEdit($id)
    {
        $editAmenities = Amenities::findOrFail($id);
        return view('admin.backend.amenities.edit_amenities', compact('editAmenities'));
    }
    // Updateamenities
    public function Updateamenities(Request $request)
    {
        $pid = $request->id;

        Amenities::findOrFail($pid)->update([
            'amenities_name' => $request->amenities_name,
            'updated_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'Amenities Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.amenities')->with($notification);
    }
    // amenitiesDelete
    public function amenitiesDelete($id)
    {
        Amenities::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Amenities Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
