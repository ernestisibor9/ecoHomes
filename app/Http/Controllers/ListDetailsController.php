<?php

namespace App\Http\Controllers;

use App\Models\ListProperty;
use App\Models\MultiPhotoProperty;
use App\Models\PropertyView;
use App\Models\ReportListing;
use Illuminate\Http\Request;
use GeoIp2\Database\Reader;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client; // For making API requests
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ListDetailsController extends Controller
{
    // listPropertyDetails
    public function listPropertyDetails($id, $slug)
    {
        // Attempt to fetch the property from both tables
        $property = ListProperty::find($id);

        $userId = auth()->check() ? auth()->id() : null;
         $ipAddress = request()->ip();
        // $ipAddress = '1.1.1.1';

        // Check if this view already exists (prevent duplicate views)
        $existingView = PropertyView::where('list_property_id', $id)
            ->where(function ($query) use ($userId, $ipAddress) {
                $query->where('user_id', $userId)
                    ->orWhere('ip_address', $ipAddress);
            })->first();

        if (!$existingView) {
            // Fetch location using ip-api
            $location = 'Unknown';
            try {
                $response = Http::get("http://ip-api.com/json/{$ipAddress}");

                if ($response->successful()) {
                    $data = $response->json();
                    Log::info('Geolocation API Response: ' . json_encode($data));

                    $city = $data['city'] ?? 'Unknown';
                    $region = $data['regionName'] ?? 'Unknown';
                    $country = $data['country'] ?? 'Unknown';
                    $location = "{$city}, {$region}, {$country}";
                }
            } catch (\Exception $e) {
                Log::error('Geolocation API Error: ' . $e->getMessage());
            }

            // Store the property view
            PropertyView::create([
                'list_property_id' => $id,
                'user_id' => $userId,
                'ip_address' => $ipAddress,
                'location' => $location
            ]);
        }


        $guest_facilities = json_decode($property->guest_facilities, true);

        // Initialize variables
        $multiImage = [];
        $multiImage = MultiPhotoProperty::where('list_property_id', $id)->get();
        $prices = ListProperty::select('price')->distinct()->orderBy('price', 'asc')->get();

        $listProperties = ListProperty::latest()->paginate(12);

        $currency = 'NGN'; // Default currency
        $exchangeRate = 1.0; // Default exchange rate

        // Get property location details
        $latitude = $property->latitude ?? 6.5244; // Default Lagos, Nigeria
        $longitude = $property->longitude ?? 3.3792; // Default Lagos, Nigeria

        // Fetch user's IP and location details
        $ip = request()->ip();

        if ($ip == '127.0.0.1' || $ip == '::1') {
            // Handle local requests
            return view('frontend.list_property.property_details', compact(
                'property',
                'multiImage',
                'currency',
                'exchangeRate', // Pass exchange rate to the view
                'latitude',
                'longitude',
                'guest_facilities'
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
        foreach ($property as $property) {
            $property->price_converted = $property->price * $exchangeRate;
        }

        foreach ($listProperties as $property) {
            $property->price_converted = $property->price * $exchangeRate;
        }

        foreach ($listProperties as $pro) {
            $pro->price_converted = $pro->price * $exchangeRate;
        }

        foreach ($prices as $price) {
            $price->converted_price = $price->$price  * $exchangeRate; // Apply exchange rate conversion
        }

        return view('frontend.list_property.property_details', compact(
            'property',
            'multiImage',
            'guest_facilities',
            'currency',
            'exchangeRate' // Pass exchange rate to the view
        ));

        abort(404, 'Property not found');
    }

    // Fetch exchange rate using an external API
    private function fetchExchangeRate($baseCurrency, $targetCurrency)
    {
        $cacheKey = "exchange_rate_{$baseCurrency}_{$targetCurrency}";



        // Check cache first
        return Cache::remember($cacheKey, 3600, function () use ($baseCurrency, $targetCurrency) {
            try {
                $client = new Client();
                $response = $client->get('https://v6.exchangerate-api.com/v6/4a33dde88ef89e91f1ee13a8/latest/' . $baseCurrency);
                $data = json_decode($response->getBody(), true);

                return $data['conversion_rates'][$targetCurrency] ?? 1.0; // Default to 1.0 if not found
            } catch (\Exception $e) {
                Log::error('Exchange Rate API Error: ' . $e->getMessage());
                return 1.0; // Default exchange rate in case of error
            }
        });
    }

    // Handle local development and Nigeria-specific requests
    public function handleLocalRequest($property, $currency, $exchangeRate)
    {
        $currency = 'NGN'; // Always use NGN for local development or Nigeria
        $exchangeRate = 1.0; // No conversion for NGN

        $amenities = $property->amenities_id; // Get amenities_id
        $property_amen = explode(',', $amenities);

        $guest_facilities = json_decode($property->guest_facilities, true);

        $multiImage = MultiPhotoProperty::where('list_property_id', $property->id)->get();
        return view('frontend.list_property.property_details', compact(
            'property',
            'multiImage',
            'currency',
            'guest_facilities',
            'exchangeRate',
        ));

        abort(404, 'Property not found');
    }

    // storeReportListing
    public function storeReportListing(Request $request, $id)
    {
        $property = ListProperty::find($id);

        if (!$property) {
            return response()->json(['message' => 'Property not found'], 404);
        }

        $report = new ReportListing();
        $report->list_property_id = $id;
        $report->reason = $request->reason;
        $report->email = $request->email;
        $report->name = $request->name;
        $report->comment = $request->comment;
        $report->save();

        // return response()->json(['message' => 'Report sent successfully'], 200);
        return redirect()->back()->with('success', 'Report sent successfully');
    }







    //////////////////////////////////////////////
    // public function showPropertyDetails($id, $slug){
    //     $property = ListProperty::findOrFail($id);
    //     $userId = auth()->check() ? auth()->id() : null;
    //     $ipAddress = request()->ip();

    //     // Check if this view already exists (prevent duplicate views)
    //     $existingView = PropertyView::where('list_property_id', $id)
    //         ->where(function ($query) use ($userId, $ipAddress) {
    //             $query->where('user_id', $userId)
    //                   ->orWhere('ip_address', $ipAddress);
    //         })->first();

    //     if (!$existingView) {
    //         // Fetch location using Geolocation-DB API
    //         $location = 'Unknown';
    //         try {
    //             $apiKey = 'e2bfd850-e6d9-11ef-bc40-012fd2b64c41';
    //             $response = Http::get("https://geolocation-db.com/json/{$apiKey}/{$ipAddress}");

    //             if ($response->successful()) {
    //                 $data = $response->json();
    //                 if (isset($data['city'], $data['country_name'])) {
    //                     $location = "{$data['city']}, {$data['country_name']}";
    //                 }
    //             }
    //         } catch (\Exception $e) {
    //             // Fallback to 'Unknown' in case of failure
    //             return redirect()->back()->with('error', $e->getMessage());
    //         }

    //         // Store the property view
    //         PropertyView::create([
    //             'list_property_id' => $id,
    //             'user_id' => $userId,
    //             'ip_address' => $ipAddress,
    //             'location' => $location
    //         ]);
    //     }

    //     return view('admin.backend.property.all_property', compact('property'));
    // }

}
