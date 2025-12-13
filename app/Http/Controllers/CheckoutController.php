<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Add items to your cart before checking out.');
        }

        $products = Product::whereIn('id', array_keys($cart))->get();

        if ($products->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'No valid items found in your cart.');
        }

        // Ensure inventory is available before charging.
        foreach ($products as $product) {
            $qty = $cart[$product->id] ?? 0;
            if ($qty < 1 || $qty > $product->inventory) {
                return redirect()->route('cart.index')->with('error', "Not enough inventory for {$product->name}.");
            }
        }

        $order = DB::transaction(function () use ($request, $products, $cart) {
            $user = $request->user();
            $total = 0;

            $order = Order::create([
                'user_id' => $user->id,
                'status' => 'processing',
                'total' => 0,
                'placed_at' => now(),
            ]);

            foreach ($products as $product) {
                $quantity = $cart[$product->id];
                $subtotal = $product->price * $quantity;
                $total += $subtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ]);

                $product->decrement('inventory', $quantity);
            }

            $order->update([
                'total' => $total,
                'status' => 'processing',
            ]);

            return $order;
        });

        $request->session()->forget('cart');

        return redirect()->route('orders.show', $order)->with('status', 'Order placed!');
    }
}
