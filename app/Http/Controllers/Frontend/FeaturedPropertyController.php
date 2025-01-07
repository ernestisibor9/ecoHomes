<?php

namespace App\Http\Controllers\frontend;


use App\Http\Controllers\Controller;

use App\Models\Property;

use Illuminate\Http\Request;
use GeoIp2\Database\Reader;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client; // For making API requests
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class FeaturedPropertyController extends Controller
{
    //
    public function showFeaturedProperties()
{
    $properties = Property::where('status', '1')
        ->where('featured', '1')
        ->limit(12)
        ->get();

        Log::info('Number of properties retrieved: ' . $properties->count());

    $currency = 'NGN'; // Default currency
    $exchangeRate = 1.0; // Default exchange rate

    try {
        // GeoIP lookup
        $reader = new Reader(storage_path('geoip/GeoLite2-City.mmdb'));
        $ip = request()->ip();
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

    return view('frontend.home.features', compact('properties', 'currency', 'exchangeRate'));
}

private function getCurrencyForCountry($country)
{
    $currencyMap = [
        'Germany' => 'EUR',
        'United States' => 'USD',
        'Nigeria' => 'NGN',
        'United Kingdom' => 'GBP',
        'Canada' => 'CAD',
        'Australia' => 'AUD',
        'Japan' => 'JPY',
        'India' => 'INR',
        'China' => 'CNY',
        'South Africa' => 'ZAR',
        'Kenya' => 'KES',
        'Brazil' => 'BRL',
        'Mexico' => 'MXN',
        'Saudi Arabia' => 'SAR',
        'United Arab Emirates' => 'AED',
        'Russia' => 'RUB',
        'France' => 'EUR',
        'Italy' => 'EUR',
        'Spain' => 'EUR',
        'Sweden' => 'SEK',
        'Norway' => 'NOK',
        'Switzerland' => 'CHF',
        'Turkey' => 'TRY',
        'Argentina' => 'ARS',
        'Egypt' => 'EGP',
        'Ghana' => 'GHS',
    ];

    return $currencyMap[$country] ?? 'USD'; // Default to USD
}

private function fetchExchangeRate($baseCurrency, $targetCurrency)
{
    $cacheKey = "exchange_rate_{$baseCurrency}_{$targetCurrency}";

    // Check cache first
    return Cache::remember($cacheKey, 3600, function () use ($baseCurrency, $targetCurrency) {
        try {
            $client = new Client();
            $response = $client->get('https://v6.exchangerate-api.com/v6/your-api-key/latest/' . $baseCurrency);
            $data = json_decode($response->getBody(), true);

            return $data['conversion_rates'][$targetCurrency] ?? 1.0; // Default to 1.0 if not found
        } catch (\Exception $e) {
            Log::error('Exchange Rate API Error: ' . $e->getMessage());
            return 1.0; // Default exchange rate in case of error
        }
    });
}

}
