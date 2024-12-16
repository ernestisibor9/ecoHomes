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
use Carbon\Carbon;
use Illuminate\Http\Request;
use GeoIp2\Database\Reader;
use Illuminate\Support\Facades\Http;
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
        if ($request->filled('price')) {
            $query->where('price', $request->price);
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
        $sortedData2 = Property::where('status', '1')->paginate(6); // Paginate properties with 2 items per page

        // Fetch additional data for filtering (status, types, etc.)
        $propertyStatusRent = Property::where('property_status', 'rent')->get();
        $propertyStatusBuy = Property::where('property_status', 'buy')->get();
        $propertyStatusSell = Property::where('property_status', 'sell')->get();
        $propertyTypes = PropertyType::orderBy('type_name', 'asc')->get();
        $propertyRooms = Property::select('bedrooms')
            ->distinct()
            ->orderBy('bedrooms', 'asc')
            ->get();
        $priceLowest = Property::select('price')
            ->distinct()
            ->orderBy('price', 'asc')
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

        $currency = 'USD'; // Default currency

        // Fetch user's IP and location details
        $ip = request()->ip(); // Get user IP address

        // Handle local IP (127.0.0.1 or ::1)
        if ($ip == '127.0.0.1' || $ip == '::1') {
            // For local development, assume Nigeria (NGN) as the default currency
            return $this->handleLocalRequestList(
                $sortedData2,
                $propertyStatusRent,
                $propertyStatusSell,
                $propertyStatusBuy,
                $propertyTypes,
                $countries,
                $propertyRooms,
                $priceLowest,
                $priceMax,
                $propertyStatus,
                $currency
            );
        }

        try {
            // Path to the GeoLite2 database
            $reader = new Reader(storage_path('geoip/GeoLite2-City.mmdb'));
            $record = $reader->city($ip);

            // Retrieve country name and currency code (if available)
            $country = $record->country->name ?? 'Unknown';
            $currency = $this->getCurrencyForCountry($country); // Custom helper for currency
        } catch (\Exception $e) {
            // Log the error and use default currency
            Log::error('GeoLite2 Error: ' . $e->getMessage());
        }

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
            'propertyStatus',
            'currency'
        ));
    }

    //

    public function handleLocalRequestList(
        $sortedData2,
        $propertyStatusRent,
        $propertyStatusSell,
        $propertyStatusBuy,
        $propertyTypes,
        $countries,
        $propertyRooms,
        $priceLowest,
        $priceMax,
        $propertyStatus,
        $currency
    ) {
        $currency = 'NGN'; // Default currency for local development

        if ($sortedData2) {
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
                'propertyStatus',
                'currency'
            ));
        }

        abort(404, 'Property not found');
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
        $priceLowest = Property::select('price')
            ->distinct()
            ->orderBy('price', 'asc')
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

        if ($request->filled('price')) {
            $query->where('price', '>=', $request->price);
        }

        if ($request->filled('maximum_price')) {
            $query->where('maximum_price', '<=', $request->maximum_price);
        }

        // Add condition to check if the property is approved or has status 1
        $query->where(function ($q) {
            $q->where('status', '1');
        });

        // Get the filtered properties
        $paginatedData = $query->paginate(6);

        $currency = 'USD'; // Default currency

        // Fetch user's IP and location details
        $ip = request()->ip(); // Get user IP address

        // Handle local IP (127.0.0.1 or ::1)
        if ($ip == '127.0.0.1' || $ip == '::1') {
            // For local development, assume Nigeria (NGN) as the default currency
            return $this->handleLocalRequestBook(
                $paginatedData,
                $propertyStatusRent,
                $propertyStatusSell,
                $propertyStatusBuy,
                $propertyTypes,
                $countries,
                $propertyRooms,
                $priceLowest,
                $priceMax,
                $propertyStatus,
                $currency
            );
        }

        try {
            // Path to the GeoLite2 database
            $reader = new Reader(storage_path('geoip/GeoLite2-City.mmdb'));
            $record = $reader->city($ip);

            // Retrieve country name and currency code (if available)
            $country = $record->country->name ?? 'Unknown';
            $currency = $this->getCurrencyForCountry($country); // Custom helper for currency
        } catch (\Exception $e) {
            // Log the error and use default currency
            Log::error('GeoLite2 Error: ' . $e->getMessage());
        }


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
            'currency',
            'paginatedData',  // Use paginated data here
        ));
    }

    //
    public function handleLocalRequestBook(
        $paginatedData,
        $propertyStatusRent,
        $propertyStatusSell,
        $propertyStatusBuy,
        $propertyTypes,
        $countries,
        $propertyRooms,
        $priceLowest,
        $priceMax,
        $propertyStatus,
        $currency
    ) {
        $currency = 'NGN'; // Default currency for local development

        if ($paginatedData) {
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
                'currency',
                'paginatedData',
            ));
        }

        abort(404, 'Property not found');
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
        $priceLowest = Property::select('price')
            ->distinct()
            ->orderBy('price', 'asc')
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
        $paginatedData = $query->paginate(6);


        $currency = 'USD'; // Default currency

        // Fetch user's IP and location details
        $ip = request()->ip(); // Get user IP address

        // Handle local IP (127.0.0.1 or ::1)
        if ($ip == '127.0.0.1' || $ip == '::1') {
            // For local development, assume Nigeria (NGN) as the default currency
            return $this->handleLocalRequestStatus(
                $paginatedData,
                $propertyStatusRent,
                $propertyStatusSell,
                $propertyStatusBuy,
                $propertyTypes,
                $countries,
                $propertyRooms,
                $priceLowest,
                $priceMax,
                $propertyStatus,
                $currency
            );
        }

        try {
            // Path to the GeoLite2 database
            $reader = new Reader(storage_path('geoip/GeoLite2-City.mmdb'));
            $record = $reader->city($ip);

            // Retrieve country name and currency code (if available)
            $country = $record->country->name ?? 'Unknown';
            $currency = $this->getCurrencyForCountry($country); // Custom helper for currency
        } catch (\Exception $e) {
            // Log the error and use default currency
            Log::error('GeoLite2 Error: ' . $e->getMessage());
        }


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
            'currency',
            'paginatedData'  // Use the paginated data here
        ));
    }
    // filterTypeProperties
    //

    public function handleLocalRequestStatus(
        $paginatedData,
        $propertyStatusRent,
        $propertyStatusSell,
        $propertyStatusBuy,
        $propertyTypes,
        $countries,
        $propertyRooms,
        $priceLowest,
        $priceMax,
        $propertyStatus,
        $currency
    ) {
        $currency = 'NGN'; // Default currency for local development

        if ($paginatedData) {
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
                'currency',
                'paginatedData',
            ));
        }

        abort(404, 'Property not found');
    }


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
        $priceLowest = Property::select('price')
            ->distinct()
            ->orderBy('price', 'asc')
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
        // Get the filtered properties with pagination
        $paginatedData = $query->paginate(6);

        $currency = 'USD'; // Default currency

        // Fetch user's IP and location details
        $ip = request()->ip(); // Get user IP address

        // Handle local IP (127.0.0.1 or ::1)
        if ($ip == '127.0.0.1' || $ip == '::1') {
            // For local development, assume Nigeria (NGN) as the default currency
            return $this->handleLocalRequestTypes(
                $paginatedData,
                $propertyStatusRent,
                $propertyStatusSell,
                $propertyStatusBuy,
                $propertyTypes,
                $countries,
                $propertyRooms,
                $priceLowest,
                $priceMax,
                $propertyStatus,
                $currency
            );
        }

        try {
            // Path to the GeoLite2 database
            $reader = new Reader(storage_path('geoip/GeoLite2-City.mmdb'));
            $record = $reader->city($ip);

            // Retrieve country name and currency code (if available)
            $country = $record->country->name ?? 'Unknown';
            $currency = $this->getCurrencyForCountry($country); // Custom helper for currency
        } catch (\Exception $e) {
            // Log the error and use default currency
            Log::error('GeoLite2 Error: ' . $e->getMessage());
        }


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
            'propertyStatusSell',
            'currency',
        ));
    }
    //
    public function handleLocalRequestTypes(
        $paginatedData,
        $propertyStatusRent,
        $propertyStatusSell,
        $propertyStatusBuy,
        $propertyTypes,
        $countries,
        $propertyRooms,
        $priceLowest,
        $priceMax,
        $propertyStatus,
        $currency
    ) {
        $currency = 'NGN'; // Default currency for local development

        if ($paginatedData) {
            return view('frontend.book.list_properties_type', compact(
                'propertyStatusRent',
                'propertyStatusBuy',
                'propertyStatusSell',
                'propertyTypes',
                'countries',
                'propertyRooms',
                'priceLowest',
                'priceMax',
                'propertyStatus',
                'currency',
                'paginatedData',
            ));
        }

        abort(404, 'Property not found');
    }
    // SearchBookProperty
    public function SearchPriceProperty(Request $request)
    {
        $propertyStatusRent = Property::where('property_status', 'rent')->get();
        $propertyStatusBuy = Property::where('property_status', 'buy')->get();
        $propertyStatusSell = Property::where('property_status', 'sell')->get();
        $propertyTypes = PropertyType::orderBy('type_name', 'asc')->get();
        $propertyRooms = Property::select('bedrooms')->distinct()->orderBy('bedrooms', 'asc')->get();
        $priceLowest = Property::select('price')->distinct()->orderBy('price', 'asc')->get();
        $priceMax = Property::select('price')->distinct()->orderBy('price', 'desc')->get(); // Adjusted to query `price`
        $propertyStatus = Property::select('property_status')->distinct()->orderBy('property_status', 'asc')->get();
        $countries = Country::get();

        $query = Property::query();

        // Filter by property type, location, and other fields
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

        // Adjust price filtering
        if ($request->filled('price') && $request->filled('maximum_price')) {
            $query->whereBetween('price', [
                $request->price,
                $request->maximum_price,
            ]);
        }

        $paginatedData = $query->paginate(6);

        $currency = 'USD'; // Default currency
        $ip = request()->ip();

        if ($ip == '127.0.0.1' || $ip == '::1') {
            // Localhost testing
            return $this->handleLocalRequestPrice(
                $paginatedData,
                $propertyStatusRent,
                $propertyStatusSell,
                $propertyStatusBuy,
                $propertyTypes,
                $countries,
                $propertyRooms,
                $priceLowest,
                $priceMax,
                $propertyStatus,
                $currency
            );
        }

        try {
            $reader = new Reader(storage_path('geoip/GeoLite2-City.mmdb'));
            $record = $reader->city($ip);
            $country = $record->country->name ?? 'Unknown';
            $currency = $this->getCurrencyForCountry($country);
        } catch (\Exception $e) {
            Log::error('GeoLite2 Error: ' . $e->getMessage());
        }

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
            'paginatedData',
            'currency'
        ));
    }

    //
    public function handleLocalRequestPrice(
        $paginatedData,
        $propertyStatusRent,
        $propertyStatusSell,
        $propertyStatusBuy,
        $propertyTypes,
        $countries,
        $propertyRooms,
        $priceLowest,
        $priceMax,
        $propertyStatus,
        $currency
    ) {
        $currency = 'NGN'; // Default currency for local development

        if ($paginatedData) {
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
                'currency',
                'paginatedData',
            ));
        }

        abort(404, 'Property not found');
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
        $currency = 'USD'; // Default currency

        // Fetch user's IP and location details
        $ip = request()->ip(); // Get user IP address

        // Handle local IP (127.0.0.1 or ::1)
        if ($ip == '127.0.0.1' || $ip == '::1') {
            // For local development, assume Nigeria (NGN) as the default currency
            return $this->handleLocalRequest($property, $sellProperty, $currency);
        }

        try {
            // Path to the GeoLite2 database
            $reader = new Reader(storage_path('geoip/GeoLite2-City.mmdb'));
            $record = $reader->city($ip);

            // Retrieve country name and currency code (if available)
            $country = $record->country->name ?? 'Unknown';
            $currency = $this->getCurrencyForCountry($country); // Custom helper for currency
        } catch (\Exception $e) {
            // Log the error and use default currency
            Log::error('GeoLite2 Error: ' . $e->getMessage());
        }

        // Fetch property amenities and images if property exists
        if ($property) {
            $amenities = $property->amenities_id ?? '';
            $amenitiesIds = $amenities ? explode(',', $amenities) : [];
            $property_amen = Amenities::whereIn('id', $amenitiesIds)->pluck('amenities_name')->toArray();
            $multiImage = MultiImage::where('property_id', $id)->get();

            return view('frontend.book.book_property_details', compact(
                'property',
                'multiImage',
                'property_amen',
                'currency' // Pass currency to the view
            ));
        }

        // If no property found, fallback to SellMyProperty data
        if ($sellProperty) {
            $amenitiesIds = $sellProperty->amenities ? json_decode($sellProperty->amenities, true) : [];
            $amenitiesSell = Amenities::whereIn('id', $amenitiesIds)->pluck('amenities_name')->toArray();
            return view('frontend.book.book_property_details', compact(
                'sellProperty',
                'amenitiesSell',
                'currency' // Pass currency to the view
            ));
        }

        abort(404, 'Property not found');
    }

    //
    // Currency conversion method
    // Handle the local development request by returning default values
    public function handleLocalRequest($property, $sellProperty, $currency)
    {
        $currency = 'NGN'; // Default currency for local development

        if ($property) {
            $multiImage = MultiImage::where('property_id', $property->id)->get();
            return view('frontend.book.book_property_details', compact(
                'property',
                'multiImage',
                'currency'
            ));
        }

        if ($sellProperty) {
            $amenitiesIds = $sellProperty->amenities ? json_decode($sellProperty->amenities, true) : [];
            $amenitiesSell = Amenities::whereIn('id', $amenitiesIds)->pluck('amenities_name')->toArray();
            return view('frontend.book.book_property_details', compact(
                'sellProperty',
                'amenitiesSell',
                'currency'
            ));
        }

        abort(404, 'Property not found');
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
    public function UserAuthBook($id)
    {
        $userData = Auth::user();
        $properties = Property::where('id', $id)->first();
        // Check if the user is logged in
        if (!Auth::check()) {
            $notification = array(
                'message' => "You have to have an account before you {$properties->property_status} a property",
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

        return view('frontend.book.user_bookings', compact('properties', 'userData'));
    }
    //
    public function StoreBooking(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'property_name' => 'required|string|max:255',
            'property_type' => 'required|string|max:255',
            'property_code' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        // Save data to the database
        $booking = Booking::create($validated);

        $notification = array(
            'message' => "Booking successfully submitted!",
            'alert-type' => 'success',
        );

        // Redirect with success message
        return redirect()->back()->with($notification);
    }
    // StoreBookingGuest
    public function StoreBookingGuest(Request $request){
        // Validate the request data
        $validated = $request->validate([
            // 'name' => 'required|string|max:255',
            // 'email' => 'required|email',
            // 'phone' => 'required|string|max:15',
            // 'property_name' => 'required|string|max:255',
            // 'property_type' => 'required|string|max:255',
            // 'property_code' => 'required|string|max:255',
            // 'country' => 'required|string|max:255',
            // 'state' => 'required|string|max:255',
            // 'city' => 'required|string|max:255',
            // 'price' => 'required|numeric',
        ]);

        // Save data to the database
        Booking::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'property_name' => $request->property_name,
            'property_type' => $request->property_type,
            'property_code' => $request->property_code,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'price' => $request->price,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => "Booking successfully submitted!",
            'alert-type' => 'success',
        );

        // Redirect with success message
        return redirect()->back()->with($notification);
    }

    // FilterSortProperties
    public function filterSortProperties(Request $request)
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
        $priceLowest = Property::select('price')
            ->distinct()
            ->orderBy('price', 'asc')
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

            // Apply sorting
    if ($request->filled('sort')) {
        switch ($request->sort) {
            case 'latest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'asc':
                $query->orderBy('price', 'asc');
                break;
            case 'desc':
                $query->orderBy('price', 'desc');
                break;
        }
    }

        // Get the filtered properties
        $paginatedData = $query->paginate(6);


        $currency = 'USD'; // Default currency

        // Fetch user's IP and location details
        $ip = request()->ip(); // Get user IP address

        // Handle local IP (127.0.0.1 or ::1)
        if ($ip == '127.0.0.1' || $ip == '::1') {
            // For local development, assume Nigeria (NGN) as the default currency
            return $this->handleLocalRequestSort(
                $paginatedData,
                $propertyStatusRent,
                $propertyStatusSell,
                $propertyStatusBuy,
                $propertyTypes,
                $countries,
                $propertyRooms,
                $priceLowest,
                $priceMax,
                $propertyStatus,
                $currency
            );
        }

        try {
            // Path to the GeoLite2 database
            $reader = new Reader(storage_path('geoip/GeoLite2-City.mmdb'));
            $record = $reader->city($ip);

            // Retrieve country name and currency code (if available)
            $country = $record->country->name ?? 'Unknown';
            $currency = $this->getCurrencyForCountry($country); // Custom helper for currency
        } catch (\Exception $e) {
            // Log the error and use default currency
            Log::error('GeoLite2 Error: ' . $e->getMessage());
        }


        // Return the view with paginated data and other variables
        return view('frontend.book.list_properties_sort', compact(
            'propertyStatusRent',
            'propertyStatusBuy',
            'propertyStatusSell',
            'propertyTypes',
            'countries',
            'propertyRooms',
            'priceLowest',
            'priceMax',
            'propertyStatus',
            'currency',
            'paginatedData'  // Use the paginated data here
        ));
    }
    //
    public function handleLocalRequestSort(
        $paginatedData,
        $propertyStatusRent,
        $propertyStatusSell,
        $propertyStatusBuy,
        $propertyTypes,
        $countries,
        $propertyRooms,
        $priceLowest,
        $priceMax,
        $propertyStatus,
        $currency
    ) {
        $currency = 'NGN'; // Default currency for local development

        if ($paginatedData) {
            return view('frontend.book.list_properties_sort', compact(
                'propertyStatusRent',
                'propertyStatusBuy',
                'propertyStatusSell',
                'propertyTypes',
                'countries',
                'propertyRooms',
                'priceLowest',
                'priceMax',
                'propertyStatus',
                'currency',
                'paginatedData',
            ));
        }

        abort(404, 'Property not found');
    }
}


