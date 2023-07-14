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
        if ($request->routeIs('admin.auth.*') and Auth::guard('web')->check()) {
            return to_route(RouteServiceProvider::__DASHBOARD);

//        } elseif ($request->path() == 'verification' and Auth::guard('customer_web')->check()) {
//            return to_route('home');
        } elseif (session()->has('auth') && $request->routeIs('admin.auth.check')) {
            return to_route('admin.auth.verify');
        } elseif (!session()->has('auth') && $request->routeIs('admin.auth.verify')) {
            return to_route('admin.auth.check');
        }

        return $next($request);
    }
}
