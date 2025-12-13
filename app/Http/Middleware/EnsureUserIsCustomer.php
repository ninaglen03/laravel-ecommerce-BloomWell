<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsCustomer
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (! $user) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }

            return redirect()->route('login');
        }

        if ($user->is_admin) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Admins cannot access this area.'], 403);
            }

            return redirect()->intended('/admin/dashboard');
        }

        return $next($request);
    }
}
