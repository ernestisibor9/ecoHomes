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
        elseif ($userRole === 'seller' && $role === 'user') {
            return redirect('/seller/dashboard');
        }
        elseif ($userRole === 'admin' && $role === 'seller') {
            return redirect('/admin/dashboard');
        }
        elseif ($userRole === 'admin' && $role !== 'admin') {
            return redirect('/admin/dashboard');
        }
        elseif ($userRole === 'seller' && $role !== 'seller') {
            return redirect('/seller/dashboard');
        }
        elseif ($userRole === 'user' && $role === 'admin') {
            return redirect('/dashboard');
        }
        elseif ($userRole === 'user' && $role === 'seller') {
            return redirect('/dashboard');
        }
        elseif ($userRole === 'seller' && $role === 'user') {
            return redirect('/seller/dashboard');
        }
        return $next($request);
    }
}
