<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $user = auth()->user();

            if (! $user || ! $user->is_admin) {
                $view->with('navbarPendingAdminRequests', 0);

                return;
            }

            $pending = User::whereNotNull('admin_requested_at')
                ->where('is_admin', false)
                ->count();

            $view->with('navbarPendingAdminRequests', $pending);
        });
    }
}
