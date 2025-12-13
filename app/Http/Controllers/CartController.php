<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();

        $items = $products->map(function (Product $product) use ($cart) {
            $quantity = $cart[$product->id];
            return [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $product->price * $quantity,
            ];
        });

        $total = $items->sum('subtotal');

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        $quantity = max(1, (int) $request->input('quantity', 1));
        $cart = session()->get('cart', []);

        if ($product->inventory <= 0) {
            return back()->withErrors($product->name . ' is out of stock.');
        }

        $currentQuantity = $cart[$product->id] ?? 0;
        $newQuantity = min($currentQuantity + $quantity, $product->inventory);

        if ($newQuantity === $currentQuantity) {
            return back()->withErrors('Only ' . $product->inventory . ' units available.');
        }

        $cart[$product->id] = $newQuantity;
        session()->put('cart', $cart);

        return back()->with('status', $product->name . ' added to cart.');
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $quantity = max(0, (int) $request->input('quantity', 1));
        $cart = session()->get('cart', []);

        if ($quantity === 0) {
            unset($cart[$product->id]);
        } else {
            if ($product->inventory <= 0) {
                unset($cart[$product->id]);
                session()->put('cart', $cart);
                return back()->withErrors($product->name . ' is out of stock.');
            }

            if ($quantity > $product->inventory) {
                return back()->withErrors('Only ' . $product->inventory . ' units available.');
            }

            $cart[$product->id] = $quantity;
        }

        session()->put('cart', $cart);

        return back()->with('status', 'Cart updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);

        return back()->with('status', 'Item removed.');
    }

    public function clear(): RedirectResponse
    {
        session()->forget('cart');

        return back()->with('status', 'Cart cleared.');
    }
}
