<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use App\Models\Property;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    // CreateAvailability
    public function CreateAvailability($propertyId)
    {
        $property = Property::findOrFail($propertyId);
        return view('admin.backend.availability.create', compact('property'));
    }
    // StoreAvailability
    public function StoreAvailability(Request $request, $propertyId)
    {
        // $validated = $request->validate([
        //     'start_time' => 'required|date|after_or_equal:today',
        //     'end_time' => 'required|date|after:start_time',
        // ]);

        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date', // Ensure end date is after or equal to start date
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ]);

        Availability::create([
            'property_id' => $propertyId,
            'start_date' => $request->start_date,  // Store the start date
            'end_date' => $request->end_date,  // Store the end date
            'start_time' => $request->start_time, // Store the start time
            'end_time' => $request->end_time, // Store the end
        ]);

        $notification = array(
            'message' => 'Availability range added successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('availability.create', $propertyId)->with($notification);
    }
}
