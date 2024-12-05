<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\City;
use App\Models\Country;
use App\Models\MultiImage;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\State;
use Illuminate\Http\Request;

class BookPropertyController extends Controller
{
    // BookSearch
    public function BookSearch()
    {
        $propertyTypes = PropertyType::latest()->get();
        $properties = Property::latest()->get();
        $propertyCountries = Property::select('country_id')
            ->distinct() // This ensures uniqueness
            ->with('country') // Assuming Property model has a 'country' relationship
            ->get();
        $countries = Country::latest()->get();
        return view('frontend.book.book_search', compact('propertyTypes', 'properties', 'countries', 'propertyCountries'));
    }
    public function GetStatesBook($countryId)
    {
        $states = State::where('country_id', $countryId)->get();
        return response()->json($states); // Ensures JSON response
    }

    public function GetCitiesBook($stateId)
    {
        $cities = City::where('state_id', $stateId)->get();
        return response()->json($cities); // Ensures JSON response
    }
    // BookPropertyFilter
    public function BookPropertyFilter(Request $request)
    {
        $query = Property::query();

        if ($request->filled('ptype_id')) {
            $query->where('ptype_id', $request->ptype_id);
            // dd($request->ptype_id);
            // exit;
        }
        if ($request->filled('lowest_price')) {
            $query->where('lowest_price', $request->lowest_price);
        }
        if ($request->filled('maximum_price')) {
            $query->where('maximum_price', $request->maximum_price);
        }
        if ($request->filled('country_id')) {
            $query->where('country_id', $request->country_id);
        }
        if ($request->filled('state_id')) {
            $query->where('state_id', $request->state_id);
        }
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }
        // if ($request->filled('address')) {
        //     $query->where('address', 'like', '%' . $request->address . '%');
        // }

        $properties = $query->with(['country', 'state', 'type', 'city'])->get();
        // Extract property IDs from the collection
        $propertyIds = $properties->pluck('id')->toArray();
        $multiImages = MultiImage::where('property_id', $propertyIds)->get();

            // Prepare amenities
    $amenitiesIds = [];
    foreach ($properties as $property) {
        $ids = explode(',', $property->amenities_id); // Split each amenities_id string
        $amenitiesIds = array_merge($amenitiesIds, $ids); // Combine all IDs
    }

    // Fetch unique amenity names
    $amenities = Amenities::whereIn('id', array_unique($amenitiesIds))->get();

        return view('frontend.book.book_property', compact('properties', 'multiImages', 'amenities'));
    }
}
