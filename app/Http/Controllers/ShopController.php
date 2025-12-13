<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(): View
    {
        $products = Product::where('is_active', true)
            ->orderBy('name')
            ->paginate(12);

        return view('shop.index', compact('products'));
    }

    public function show(Product $product): View
    {
        abort_unless($product->is_active, 404);

        return view('shop.show', compact('product'));
    }
}
