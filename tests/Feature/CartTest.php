<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_can_be_added_to_cart(): void
    {
        $product = Product::factory()->create();

        $response = $this->post(route('cart.add', $product));

        $response->assertSessionHas('cart.' . $product->id, 1);
    }

    public function test_cart_page_displays_items(): void
    {
        $product = Product::factory()->create(['price' => 20]);

        $this->withSession(['cart' => [$product->id => 2]])
            ->get(route('cart.index'))
            ->assertSee($product->name)
            ->assertSee('$40.00');
    }
}
