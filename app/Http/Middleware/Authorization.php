<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authorization
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if (! $user->authorizations()->exists()) {
            return response()->json(['message' => 'No authorizations found for user.'], 403);
        }

        return $next($request);
    }
}
