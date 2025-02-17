<?php

namespace App\Http\Middleware;

use App\Models\GuestUser;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;

class TrackGuestUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $ip = $request->ip();
        // $ip = '8.8.8.8';
        $location = 'Unknown';

        // Get location
        try {
            $response = Http::get("http://ip-api.com/json/{$ip}");
            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['city'], $data['country'])) {
                    $location = "{$data['city']}, {$data['country']}";
                }
            }
        } catch (\Exception $e) {
        }

        // Update or create guest record
        GuestUser::updateOrCreate(
            ['ip_address' => $ip],
            ['last_seen' => Carbon::now(), 'location' => $location]
        );

        return $next($request);
    }
}
