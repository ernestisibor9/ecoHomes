<?php

namespace App\Http\Middleware;

use App\Models\UserProgress;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdateStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $progress = UserProgress::where('user_id', auth()->id())->first();

            // Update status if it is not already 'pending'
            if ($progress && $progress->status !== 'pending') {
                $progress->status = 'pending';
                $progress->save();
            }
        }
        return $next($request);
    }
}
