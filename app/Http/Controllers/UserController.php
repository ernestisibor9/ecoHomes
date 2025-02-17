<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\ListProperty;
use App\Models\Property;
use App\Models\Shortlet;
use App\Models\State;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GeoIp2\Database\Reader;

class UserController extends Controller
{
    // Index
    public function index(Request $request)
    {

        // Eager load rooms, roomDetails, roomImages, and facilities
        $shortlets = Shortlet::with(['rooms.details', 'rooms.roomImages', 'facilities'])->latest()->get();

        // Eager load rooms, roomDetails, roomImages, and facilities
        $hotels = Hotel::with(['rooms.details', 'rooms.roomImages', 'facilities'])->latest()->get();

        // Fetch the properties for the featured section
        $properties = Property::where('status', '1')
            ->where('featured', '1')
            ->limit(6)
            ->get();


        $prices = ListProperty::select('price')->distinct()->orderBy('price', 'asc')->get();
        $listPropertyTypes = ListProperty::select('property_type')->distinct()->orderBy('property_type', 'asc')->get();
        $listPropertyStatus = ListProperty::select('property_status')->distinct()->orderBy('property_status', 'asc')->get();
        $listProperties = ListProperty::latest()->paginate(3);


        $currency = 'NGN'; // Default currency
        $exchangeRate = 1.0; // Default exchange rate

        // Fetch user's IP and location details
        $ip = request()->ip();

        if ($ip == '127.0.0.1' || $ip == '::1') {
            if ($request->ajax()) {
                return view('frontend.home.features_property', compact(
                    'listProperties'
                ))->render();
            }
            // Handle local requests
            return view('frontend.index', compact(
                'properties',
                'listProperties',
                'currency',
                'exchangeRate',
                'hotels',
                'shortlets',
                'prices',
                'listPropertyTypes',
                'listPropertyStatus'
            ));
        }

        try {
            // GeoIP lookup
            $reader = new Reader(storage_path('geoip/GeoLite2-City.mmdb'));
            $record = $reader->city($ip);
            $country = $record->country->name ?? 'Unknown';
            $currency = $this->getCurrencyForCountry($country);

            // Fetch exchange rate
            if ($currency !== 'NGN') {
                $exchangeRate = $this->fetchExchangeRate('NGN', $currency);
            }
        } catch (\Exception $e) {
            Log::error('GeoLite2 Error: ' . $e->getMessage());
        }


        // Convert property prices based on the exchange rate
        foreach ($properties as $property) {
            $property->price_converted = $property->price * $exchangeRate;
        }

        foreach ($listProperties as $property) {
            $property->price_converted = $property->price * $exchangeRate;
        }

        foreach ($listProperties as $pro) {
            $pro->price_converted = $pro->price * $exchangeRate;
        }

        foreach ($prices as $price) {
            $price->converted_price = $price->price  * $exchangeRate; // Apply exchange rate conversion
        }

        if ($request->ajax()) {
            return view('frontend.home.features_property', compact(
                'listProperties'
            ))->render();
        }

        // Return the main index view, including the features section
        return view('frontend.index', compact(
            'properties',
            'listProperties',
            'listPropertyTypes',
            'currency',
            'exchangeRate',
            'hotels',
            'shortlets',
            '$priceByAnnum',
            'prices',
            'priceByAnnum',
            'listPropertyStatus'
        ));
    }

    private function fetchExchangeRate($baseCurrency, $targetCurrency)
    {
        $cacheKey = "exchange_rate_{$baseCurrency}_{$targetCurrency}";

        return Cache::remember($cacheKey, 3600, function () use ($baseCurrency, $targetCurrency) {
            try {
                $client = new Client();
                $response = $client->get('https://v6.exchangerate-api.com/v6/4a33dde88ef89e91f1ee13a8/latest/' . $baseCurrency);
                $data = json_decode($response->getBody(), true);

                return $data['conversion_rates'][$targetCurrency] ?? 1.0;
            } catch (\Exception $e) {
                Log::error('Exchange Rate API Error: ' . $e->getMessage());
                return 1.0;
            }
        });
    }

    private function getCurrencyForCountry($country)
    {
        $currencyMap = [
            'Germany' => 'EUR',          // Euro
            'United States' => 'USD',    // US Dollar
            'Nigeria' => 'NGN',          // Nigerian Naira
            'United Kingdom' => 'GBP',   // British Pound
            'Canada' => 'CAD',           // Canadian Dollar
            'Australia' => 'AUD',        // Australian Dollar
            'Japan' => 'JPY',            // Japanese Yen
            'India' => 'INR',            // Indian Rupee
            'China' => 'CNY',            // Chinese Yuan
            'South Africa' => 'ZAR',     // South African Rand
            'Kenya' => 'KES',            // Kenyan Shilling
            'Brazil' => 'BRL',           // Brazilian Real
            'Mexico' => 'MXN',           // Mexican Peso
            'Saudi Arabia' => 'SAR',     // Saudi Riyal
            'United Arab Emirates' => 'AED', // UAE Dirham
            'Russia' => 'RUB',           // Russian Ruble
            'France' => 'EUR',           // Euro (shared currency)
            'Italy' => 'EUR',            // Euro (shared currency)
            'Spain' => 'EUR',            // Euro (shared currency)
            'Sweden' => 'SEK',           // Swedish Krona
            'Norway' => 'NOK',           // Norwegian Krone
            'Switzerland' => 'CHF',      // Swiss Franc
            'Turkey' => 'TRY',           // Turkish Lira
            'Argentina' => 'ARS',        // Argentine Peso
            'Egypt' => 'EGP',            // Egyptian Pound
            'Ghana' => 'GHS',            // Ghanaian Cedi
            // Add more country-to-currency mappings
        ];

        return $currencyMap[$country] ?? 'USD'; // Default to USD if not found
    }
    // UserDashboard
    public function UserDashboard()
    {
        return view('frontend.dashboard.index');
    }
    // User Logout
    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $notification = array(
            'message' => 'Logout Successfully',
            'alert-type' => 'info',
        );

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with($notification);
    }



    // Search for Properties
    public function Search2(Request $request)
    {
        $query = ListProperty::query();

        if ($request->filled('location')) {
            $location = $request->input('location');
            $query->where(function ($q) use ($location) {
                $q->whereHas('city', function ($cityQuery) use ($location) {
                    $cityQuery->where('name', 'like', '%' . $location . '%');
                })->orWhereHas('state', function ($stateQuery) use ($location) {
                    $stateQuery->where('name', 'like', '%' . $location . '%');
                });
            });
        }

        if ($request->filled('property_type')) {
            $query->where('property_type', $request->input('property_type'));
        }

        if ($request->filled('property_status')) {
            $query->where('property_status', $request->input('property_status'));
        }

        // Dump the raw SQL query to check if it's correct
        //dd($query->toSql(), $query->getBindings());

        $properties = $query->latest()->paginate(12);

        // Additional data for filtering
        $listPropertyTypes = ListProperty::select('property_type')->distinct()->orderBy('property_type', 'asc')->get();
        $listPropertyStatus = ListProperty::select('property_status')->distinct()->orderBy('property_status', 'asc')->get();
        $propertyStatusRent = ListProperty::where('property_status', 'rent')->get();
        $propertyStatusBuy = ListProperty::where('property_status', 'buy')->get();
        $propertyStatusLease = ListProperty::where('property_status', 'lease')->get();
        $propertyStatusSell = ListProperty::where('property_status', 'sell')->get();
        $propertyRooms = ListProperty::select('bedroom')->distinct()->orderBy('bedroom', 'asc')->get();
        $priceLowest = ListProperty::select('price')->distinct()->orderBy('price', 'asc')->get();
        $countries = Country::get();

        // Currency and exchange rate logic
        $currency = 'NGN'; // Default currency
        $exchangeRate = 1.0; // Default exchange rate

        // Fetch user's IP and location details
        $ip = request()->ip();

        // Handle local requests
        if ($ip == '127.0.0.1' || $ip == '::1') {
            return view('frontend.search.results', compact(
                'propertyStatusRent',
                'propertyStatusBuy',
                'propertyStatusSell',
                'countries',
                'propertyStatusLease',
                'currency',
                'priceLowest',
                'exchangeRate',
                'properties',
                'listPropertyStatus',
                'listPropertyTypes'
            ));
        }

        try {
            // GeoIP lookup
            $reader = new Reader(storage_path('geoip/GeoLite2-City.mmdb'));
            $record = $reader->city($ip);
            $country = $record->country->name ?? 'Unknown';
            $currency = $this->getCurrencyForCountry($country);

            // Fetch exchange rate
            if ($currency !== 'NGN') {
                $exchangeRate = $this->fetchExchangeRate('NGN', $currency);
            }
        } catch (\Exception $e) {
            Log::error('GeoLite2 Error: ' . $e->getMessage());
        }

        // Convert property prices based on exchange rate
        foreach ($properties as $property) {
            $property->price_converted = $property->price * $exchangeRate; // Apply exchange rate conversion
        }

        // Convert priceLowest and priceMax based on exchange rate
        foreach ($priceLowest as $price) {
            $price->converted_price = $price->price * $exchangeRate; // Apply exchange rate conversion
        }

        // Return view with filtered properties and other data
        return view('frontend.search.results', compact(
            'propertyStatusRent',
            'propertyStatusBuy',
            'propertyStatusSell',
            'countries',
            'propertyStatusLease',
            'currency',
            'priceLowest',
            'exchangeRate',
            'properties',
            'listPropertyStatus',
            'listPropertyTypes'
        ));
    }

    public function GetLocations2(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json([]);
        }

        $cities = City::where('name', 'like', "%{$query}%")->select('id', 'name')->get();
        $states = State::where('name', 'like', "%{$query}%")->select('id', 'name')->get();

        $locations = $cities->merge($states)->unique('name')->values(); // Use ->values() to reindex

        return response()->json($locations);
    }
}
