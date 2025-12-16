<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminAccessRequestController extends Controller
{
    public function index(): View
    {
        $pendingRequests = User::query()
            ->whereNotNull('admin_requested_at')
            ->where('is_admin', false)
            ->orderByDesc('admin_requested_at')
            ->get();

        return view('admin.requests.index', compact('pendingRequests'));
    }

    public function approve(User $user): RedirectResponse
    {
        if (! $user->admin_requested_at || $user->is_admin) {
            abort(404);
        }

        $user->forceFill([
            'is_admin' => true,
            'must_change_password' => false,
            'admin_approved_at' => now(),
            'admin_requested_at' => null,
            'admin_denied_at' => null,
        ])->save();

        return redirect()->route('admin.requests.index')->with('status', "{$user->name} now has admin access.");
    }

    public function deny(User $user): RedirectResponse
    {
        if (! $user->admin_requested_at || $user->is_admin) {
            abort(404);
        }

        $user->forceFill([
            'admin_requested_at' => null,
            'admin_denied_at' => now(),
        ])->save();

        return redirect()->route('admin.requests.index')->with('status', "{$user->name}'s request was denied.");
    }
}
