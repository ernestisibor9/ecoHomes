<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                            // Allow access to the OTP input route
            if ($request->routeIs('otp.input')) {
                return $next($request);
            }

                if (Auth::check() && Auth::user()->role == 'user') {
                    return redirect('/dashboard');
                }
                if (Auth::check() && Auth::user()->role == 'admin') {
                    return redirect('/admin/dashboard');
                }
                if (Auth::check() && Auth::user()->role == 'seller') {
                    return redirect('/seller/dashboard');
                }

            }
        }

        return $next($request);
    }
}
