<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $userRole = $request->user()->role;

        if ($userRole === 'user' && $role !== 'user') {
            return redirect('dashboard');
        } elseif ($userRole === 'admin' && $role === 'user') {
            return redirect('/admin/dashboard');
        }
        elseif ($userRole === 'agent' && $role === 'user') {
            return redirect('/agent/dashboard');
        }
        elseif ($userRole === 'admin' && $role === 'agent') {
            return redirect('/admin/dashboard');
        }
        elseif ($userRole === 'agent' && $role === 'admin') {
            return redirect('/agent/dashboard');
        }
        return $next($request);
    }
}
