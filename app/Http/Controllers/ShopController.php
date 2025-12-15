<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(Request $request): View
    {
        $categories = [
            'all' => 'All',
            'adaptogens' => 'Adaptogens',
            'skincare' => 'Skincare',
            'pantry' => 'Pantry',
            'bath' => 'Bath',
            'tools' => 'Tools',
        ];

        $activeCategory = $request->query('category', 'all');
        if (! array_key_exists($activeCategory, $categories)) {
            $activeCategory = 'all';
        }

        $query = Product::where('is_active', true);

        if ($activeCategory !== 'all') {
            $query->where('category', $activeCategory);
        }

        $featuredProducts = (clone $query)
            ->orderBy('name')
            ->take(3)
            ->get();

        $products = (clone $query)
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        $cartCount = array_sum(session('cart', []));

        return view('shop.index', [
            'products' => $products,
            'featuredProducts' => $featuredProducts,
            'categories' => $categories,
            'activeCategory' => $activeCategory,
            'cartCount' => $cartCount,
        ]);
    }

    public function show(Product $product): View
    {
        abort_unless($product->is_active, 404);

        return view('shop.show', compact('product'));
    }
}
