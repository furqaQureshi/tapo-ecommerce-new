<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // If logged in and subscription_status == 1, block access
        if ($user && $user->subscription_status == 1) {
            return redirect()->back()->with('error', 'Already subscribed.');
        }

        return $next($request);
    }
}