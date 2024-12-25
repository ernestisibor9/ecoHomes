<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GeoIp2\Database\Reader;

class UserController extends Controller
{
    // Index
    public function index()
    {
        // Fetch the properties for the featured section
        $properties = Property::where('status', '1')
            ->where('featured', '1')
            ->limit(6)
            ->get();

        // Default currency and exchange rate
        $currency = 'NGN';
        $exchangeRate = 1.0;

        $ip = request()->ip(); // Get user IP address

        // Handle local development or Nigeria-specific logic
        if ($ip == '127.0.0.1' || $ip == '::1') {
            $currency = 'NGN';
            $exchangeRate = 1.0;
        } else {
            try {
                $reader = new Reader(storage_path('geoip/GeoLite2-City.mmdb'));
                $record = $reader->city($ip);
                $country = $record->country->name ?? 'Unknown';

                if ($country === 'Nigeria') {
                    $currency = 'NGN';
                    $exchangeRate = 1.0;
                } else {
                    $currency = $this->getCurrencyForCountry($country);
                    $exchangeRate = $this->fetchExchangeRate('USD', $currency);
                }
            } catch (\Exception $e) {
                Log::error('GeoLite2 Error: ' . $e->getMessage());
            }
        }

        // Convert property prices based on the exchange rate
        foreach ($properties as $property) {
            $property->price_converted = $property->price * $exchangeRate;
        }

        // Return the main index view, including the features section
        return view('frontend.index', compact('properties', 'currency', 'exchangeRate'));
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
}
