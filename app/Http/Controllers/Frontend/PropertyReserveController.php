<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GeoIp2\Database\Reader;
use GuzzleHttp\Client; // For making API requests
use Illuminate\Support\Facades\Cache;


class PropertyReserveController extends Controller
{
    //
    // Calculate price based on user input
    public function calculatePrice(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guest_adults' => 'required|integer|min:1',
            'guest_children' => 'nullable|integer|min:0',
            'guest_infants' => 'nullable|integer|min:0',
            'guest_pets' => 'nullable|integer|min:0',
        ]);

        $room = Property::find($validated['property_id']);
        $totalGuests = $validated['guest_adults'] + ($validated['guest_children'] ?? 0);

        // Check if total guests exceed room capacity
        if ($totalGuests > $room->guest_capacity) {
            return response()->json([
                'error' => 'Guest count exceeds room capacity.',
            ], 422);
        }

        $currency = 'NGN'; // Default currency
        $exchangeRate = 1.0; // Default exchange rate

        // Detect localhost environment
        $ip = request()->ip();
        if ($ip === '127.0.0.1' || $ip === '::1') {
            $currency = 'NGN'; // Use default currency for localhost
            $exchangeRate = 1.0;

            // Dynamically calculate days and total price for localhost
            $days = Carbon::parse($validated['check_in'])->diffInDays($validated['check_out']);
            $basePrice = $room->price_per_night * $days;
            $totalPrice = $basePrice + $room->cleaning_fee + $room->eco_home_service_fee;

            session([
                'room_details' => $room,
                'total_price' => $totalPrice,
            ]);


            return response()->json([
                'days' => $days,
                'total_price' => $totalPrice,
                'base_price' => $basePrice,
                'cleaning_fee' => $room->cleaning_fee,
                'eco_home_service_fee' => $room->eco_home_service_fee,
                'currency' => $currency,
                'exchange_rate' => $exchangeRate,
            ]);
        }

        // For non-localhost environments, fetch user's location and calculate exchange rate
        try {
            $reader = new Reader(storage_path('geoip/GeoLite2-City.mmdb'));
            $record = $reader->city($ip);
            $country = $record->country->name ?? 'Unknown';
            $currency = $this->getCurrencyForCountry($country);

            if ($currency !== 'NGN') {
                $exchangeRate = $this->fetchExchangeRate('NGN', $currency);
            }
        } catch (\Exception $e) {
            Log::error('GeoLite2 Error: ' . $e->getMessage());
        }

        $days = Carbon::parse($validated['check_in'])->diffInDays($validated['check_out']);
        $basePrice = $room->price_per_night * $days * $exchangeRate;
        $totalPrice = $basePrice + $room->cleaning_fee + $room->eco_home_service_fee;

        return response()->json([
            'days' => $days,
            'total_price' => $totalPrice,
            'base_price' => $basePrice,
            'cleaning_fee' => $room->cleaning_fee,
            'eco_home_service_fee' => $room->eco_home_service_fee,
            'currency' => $currency, // Include the currency in the response
            'exchange_rate' => $exchangeRate,
        ]);

    }


        /**
     * Get currency for a given country.
     */
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

        return $currencyMap[$country] ?? 'USD'; // Default to USD
    }

    /**
     * Fetch exchange rate between two currencies.
     */
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



    // Check if the room is available for the selected dates
    public function checkAvailability(Request $request)
    {
        $propertyId = $request->input('property_id');
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');

        // Example logic to check room availability
        $isAvailable = $this->isRoomAvailable($propertyId, $checkIn, $checkOut);

        // Return JSON response
        return response()->json([
            'available' => $isAvailable,
        ]);
    }

    private function isRoomAvailable($propertyId, $checkIn, $checkOut)
    {
        // Replace this logic with your database checks
        // Example: Check if dates overlap with existing bookings
        $bookings = Reservation::where('property_id', $propertyId)
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in', [$checkIn, $checkOut])
                      ->orWhereBetween('check_out', [$checkIn, $checkOut])
                      ->orWhere(function ($query) use ($checkIn, $checkOut) {
                          $query->where('check_in', '<=', $checkIn)
                                ->where('check_out', '>=', $checkOut);
                      });
            })
            ->exists();

        return !$bookings; // If no overlapping bookings, the room is available
    }
}
