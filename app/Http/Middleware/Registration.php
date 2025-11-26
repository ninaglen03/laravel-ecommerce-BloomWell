<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Registration
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if (! $user->registration) {
            return redirect()->route('register')->with('error', 'Please complete your registration.');
        }

        return $next($request);
    }
}
