<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'customer']);
    }

    public function index(Request $request): View
    {
        $user = $request->user();

        $openOrders = $user->orders()
            ->whereNotIn('status', ['completed', 'cancelled'])
            ->count();

        $completedOrders = $user->orders()
            ->where('status', 'completed')
            ->count();

        $lifetimeSpend = $user->orders()->sum('total');

        $recentOrders = $user->orders()
            ->with('items')
            ->orderByDesc('placed_at')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        $recommendedProducts = Product::where('is_active', true)
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        $cartQuantity = array_sum($request->session()->get('cart', []));

        return view('dashboard.index', [
            'user' => $user,
            'stats' => [
                'open_orders' => $openOrders,
                'completed_orders' => $completedOrders,
                'lifetime_spend' => $lifetimeSpend,
                'cart_quantity' => $cartQuantity,
            ],
            'recentOrders' => $recentOrders,
            'recommendedProducts' => $recommendedProducts,
        ]);
    }
}
