<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(): View
    {
        $metrics = [
            'revenue' => Order::sum('total'),
            'orders' => Order::count(),
            'processing' => Order::where('status', 'processing')->count(),
            'fulfilled' => Order::whereIn('status', ['shipped', 'completed'])->count(),
            'today' => Order::whereDate('placed_at', now()->toDateString())->sum('total'),
        ];

        $recentOrders = Order::with('user')
            ->orderByDesc('placed_at')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        $lowInventory = Product::orderBy('inventory')->limit(5)->get();

        $topProducts = OrderItem::selectRaw('product_name, SUM(quantity) as total_quantity')
            ->groupBy('product_name')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('metrics', 'recentOrders', 'lowInventory', 'topProducts'));
    }
}
