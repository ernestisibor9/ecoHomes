<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Booking;
use App\Models\City;
use App\Models\Country;
use App\Models\MultiImage;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\SellMyProperty;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

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

    // ListAllPropertyuse Illuminate\Pagination\LengthAwarePaginator;

    public function ListAllProperty()
    {
        // Fetch paginated properties
        $sortedData2 = Property::where('status', '1')->paginate(4); // Paginate properties with 2 items per page

        // Fetch additional data for filtering (status, types, etc.)
        $propertyStatusRent = Property::where('property_status', 'rent')->get();
        $propertyStatusBuy = Property::where('property_status', 'buy')->get();
        $propertyStatusSell = Property::where('property_status', 'sell')->get();
        $propertyTypes = PropertyType::orderBy('type_name', 'asc')->get();
        $propertyRooms = Property::select('bedrooms')
            ->distinct()
            ->orderBy('bedrooms', 'asc')
            ->get();
        $priceLowest = Property::select('lowest_price')
            ->distinct()
            ->orderBy('lowest_price', 'asc')
            ->get();
        $priceMax = Property::select('maximum_price')
            ->distinct()
            ->orderBy('maximum_price', 'asc')
            ->get();
        $propertyStatus = Property::select('property_status')
            ->distinct()
            ->orderBy('property_status', 'asc')
            ->get();
        $countries = Country::get();

        // Return the combined paginated data to the view
        return view('frontend.book.list_all_property', compact(
            'sortedData2',
            'propertyStatusRent',
            'propertyStatusBuy',
            'propertyStatusSell',
            'propertyTypes',
            'countries',
            'propertyRooms',
            'priceLowest',
            'priceMax',
            'propertyStatus'
        ));
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
    // SearchBookProperty

    public function SearchBookProperty(Request $request)
    {
        // Fetch all property types for the dropdown
        $propertyStatusRent = Property::where('property_status', 'rent')->get();
        $propertyStatusBuy = Property::where('property_status', 'buy')->get();
        $propertyStatusSell = Property::where('property_status', 'sell')->get();
        $propertyTypes = PropertyType::orderBy('type_name', 'asc')->get();
        $propertyRooms = Property::select('bedrooms')
            ->distinct()
            ->orderBy('bedrooms', 'asc')
            ->get();
        $priceLowest = Property::select('lowest_price')
            ->distinct()
            ->orderBy('lowest_price', 'asc')
            ->get();
        $priceMax = Property::select('maximum_price')
            ->distinct()
            ->orderBy('maximum_price', 'asc')
            ->get();
        $propertyStatus = Property::select('property_status')
            ->distinct()
            ->orderBy('property_status', 'asc')
            ->get();
        $countries = Country::get();

        // Initialize the query for property search
        $query = Property::query();

        // Apply filters based on request
        if ($request->filled('ptype_id')) {
            $query->where('ptype_id', $request->ptype_id);
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

        if ($request->filled('property_status')) {
            $query->where('property_status', $request->property_status);
        }

        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', '<=', $request->bedrooms);
        }

        if ($request->filled('lowest_price')) {
            $query->where('lowest_price', '>=', $request->lowest_price);
        }

        if ($request->filled('maximum_price')) {
            $query->where('maximum_price', '<=', $request->maximum_price);
        }

        // Add condition to check if the property is approved or has status 1
        $query->where(function ($q) {
            $q->where('status', '1');
        });

        // Get the filtered properties
        $paginatedData = $query->paginate(4);

        // Return the view with the paginated data
        return view('frontend.book.list_book_property', compact(
            'propertyStatusRent',
            'propertyStatusBuy',
            'propertyStatusSell',
            'propertyTypes',
            'countries',
            'propertyRooms',
            'priceLowest',
            'priceMax',
            'propertyStatus',
            'paginatedData',  // Use paginated data here
        ));
    }


    // filterStatusProperties
    public function filterStatusProperties(Request $request)
    {
        // Retrieve data based on different filters
        $propertyStatusRent = Property::where('property_status', 'rent')->get();
        $propertyStatusBuy = Property::where('property_status', 'buy')->get();
        $propertyStatusSell = Property::where('property_status', 'sell')->get();
        $propertyTypes = PropertyType::orderBy('type_name', 'asc')->get();
        $propertyRooms = Property::select('bedrooms')
            ->distinct()
            ->orderBy('bedrooms', 'asc')
            ->get();
        $priceLowest = Property::select('lowest_price')
            ->distinct()
            ->orderBy('lowest_price', 'asc')
            ->get();
        $priceMax = Property::select('maximum_price')
            ->distinct()
            ->orderBy('maximum_price', 'asc')
            ->get();
        $propertyStatus = Property::select('property_status')
            ->distinct()
            ->orderBy('property_status', 'asc')
            ->get();
        $countries = Country::get();

        // Set up the query for filtering properties
        $query = Property::query();

        // Apply filters based on the request
        if ($request->filled('property_status')) {
            $query->where('property_status', $request->property_status);
        }

        // Ensure that the property status is approved or has status 1
        $query->where(function ($q) {
            $q->where('status', '1');
        });

        // Get the filtered properties
        $paginatedData = $query->paginate(4);


        // Return the view with paginated data and other variables
        return view('frontend.book.list_properties_status', compact(
            'propertyStatusRent',
            'propertyStatusBuy',
            'propertyStatusSell',
            'propertyTypes',
            'countries',
            'propertyRooms',
            'priceLowest',
            'priceMax',
            'propertyStatus',
            'paginatedData'  // Use the paginated data here
        ));
    }
    // filterTypeProperties

    public function filterTypeProperties(Request $request)
    {
        // Fetch all property types for the dropdown
        $propertyStatusRent = Property::where('property_status', 'rent')->get();
        $propertyStatusBuy = Property::where('property_status', 'buy')->get();
        $propertyStatusSell = Property::where('property_status', 'sell')->get();
        $propertyTypes = PropertyType::orderBy('type_name', 'asc')->get();
        $propertyRooms = Property::select('bedrooms')
            ->distinct()
            ->orderBy('bedrooms', 'asc')
            ->get();
        $priceLowest = Property::select('lowest_price')
            ->distinct()
            ->orderBy('lowest_price', 'asc')
            ->get();
        $priceMax = Property::select('maximum_price')
            ->distinct()
            ->orderBy('maximum_price', 'asc')
            ->get();
        $propertyStatus = Property::select('property_status')
            ->distinct()
            ->orderBy('property_status', 'asc')
            ->get();
        $countries = Country::get();

        // Initialize query
        $query = Property::query();

        // Apply the filter for property type if it's provided in the request
        if ($request->filled('ptype_id')) {
            $ptype_id = $request->ptype_id;
            $query->where('ptype_id', $ptype_id);
        }

        // Add condition to check if the property is approved (status = 1)
        $query->where(function ($q) {
            $q->where('status', '1');
        });

        // Get the filtered properties
        $paginatedData = $query->get();

        // Return the view with paginated data and other variables
        return view('frontend.book.list_properties_type', compact(
            'propertyTypes',
            'countries',
            'propertyRooms',
            'priceLowest',
            'priceMax',
            'propertyStatus',
            'paginatedData',  // Use paginated data here
            'propertyStatusRent',
            'propertyStatusBuy',
            'propertyStatusSell'
        ));
    }
    //
    // SearchBookProperty
    public function SearchPriceProperty(Request $request)
    {
        $propertyStatusRent = Property::where('property_status', 'rent')->get();
        $propertyStatusBuy = Property::where('property_status', 'buy')->get();
        $propertyStatusSell = Property::where('property_status', 'sell')->get();
        $propertyTypes = PropertyType::orderBy('type_name', 'asc')->get();
        $propertyRooms = Property::select('bedrooms')
            ->distinct()
            ->orderBy('bedrooms', 'asc')
            ->get();
        $priceLowest = Property::select('lowest_price')
            ->distinct()
            ->orderBy('lowest_price', 'asc')
            ->get();
        $priceMax = Property::select('maximum_price')
            ->distinct()
            ->orderBy('maximum_price', 'asc')
            ->get();
        $propertyStatus = Property::select('property_status')
            ->distinct()
            ->orderBy('property_status', 'asc')
            ->get();
        $countries = Country::get();

        $query = Property::query();

        if ($request->filled('ptype_id')) {
            $query->where('ptype_id', $request->ptype_id);
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

        if ($request->filled('property_status')) {
            $query->where('property_status', $request->property_status);
        }

        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', '<=', $request->bedrooms);
        }

        if ($request->filled('minimum_price')) {
            $query->where('lowest_price', '>=', $request->minimum_price);
        }

        if ($request->filled('maximum_price')) {
            $query->where('maximum_price', '<=', $request->maximum_price);
        }

        $propertySearch = $query->whereBetween('lowest_price', [
            $request->lowest_price ?? 0,
            $request->maximum_price ?? PHP_INT_MAX,
        ]);

        $paginatedData  = $propertySearch->paginate(4);


        return view('frontend.book.list_price_property', compact(
            'propertyStatusRent',
            'propertyStatusBuy',
            'propertyStatusSell',
            'propertyTypes',
            'countries',
            'propertyRooms',
            'priceLowest',
            'priceMax',
            'propertyStatus',
            'paginatedData'
        ));
    }

    // BookPropertyDetails
    public function BookPropertyDetails($id, $slug)
    {
        // Attempt to fetch the property from both tables
        $property = Property::find($id);
        $sellProperty = SellMyProperty::find($id);

        // Initialize variables
        $multiImage = [];
        $property_amen = [];
        $amenitiesSell = [];

        if ($property) {
            // Fetch property amenities and split them into an array of IDs
            $amenities = $property->amenities_id ?? ''; // Ensure amenities_id exists
            $amenitiesIds = $amenities ? explode(',', $amenities) : [];

            // Fetch amenities names from the Amenities table
            $property_amen = Amenities::whereIn('id', $amenitiesIds)->pluck('amenities_name')->toArray();

            // Fetch multi images for the property
            $multiImage = MultiImage::where('property_id', $id)->get();
        }

        if ($sellProperty) {
            // Decode SellMyProperty amenities JSON and fetch names
            $amenitiesIds = $sellProperty->amenities ? json_decode($sellProperty->amenities, true) : [];
            $amenitiesSell = Amenities::whereIn('id', $amenitiesIds)->pluck('amenities_name')->toArray();
        }

        if ($property) {
            // Return the view for Property table record
            return view('frontend.book.book_property_details', compact('property', 'multiImage', 'property_amen'));
        } elseif ($sellProperty) {
            // Return the view for SellMyProperty table record
            return view('frontend.book.book_property_details', compact('sellProperty', 'amenitiesSell'));
        } else {
            // Handle the case where no record is found in either table
            abort(404, 'Property not found');
        }
    }


    // BookPropertyNow
    public function BookPropertyNow(Request $request, $propertyId)
    {
        // Ensure the user is logged in
        if (!Auth::check()) {
            $notification = array(
                'message' => 'You must log in to book a property.',
                'alert-type' => 'error',
            );
            return redirect()->route('login')->with($notification);
        }

        // Check if the property exists in either of the two tables
        $property = Property::find($propertyId);

        // If neither exists, return an error
        if (!$property) {
            $notification = array(
                'message' => 'Property not found',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }

        // Check if the user has already booked this property
        $existingBooking = Booking::where('user_id', Auth::id())
            ->where('property_id', $propertyId)
            ->first();

        if ($existingBooking) {
            $notification = array(
                'message' => 'You have already booked this property',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }

        // Create a booking record
        Booking::create([
            'user_id' => Auth::id(),
            'property_id' => $propertyId,
            'booked_at' => now(),
            'status' => 'pending',
        ]);

        $notification = array(
            'message' => 'You have successfully booked this property',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
    // UserAuthBook
    public function UserAuthBook()
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            $notification = array(
               'message' => 'Log in to book property.',
                'alert-type' => 'error',
            );
            return redirect()->route('login')->with($notification);
        }

               // Check if the user has already booked this property
        //        $existingBooking = Booking::where('user_id', Auth::id())
        //        ->where('property_id', $propertyId)
        //        ->first();

        //    if ($existingBooking) {
        //        $notification = array(
        //            'message' => 'You have already booked this property',
        //            'alert-type' => 'error',
        //        );
        //        return redirect()->back()->with($notification);
        //    }

        return view('frontend.book.user_bookings');
    }
}
