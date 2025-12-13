<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_product(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post(route('admin.products.store'), [
            'name' => 'Calm Focus Gummies',
            'price' => 29.99,
            'inventory' => 25,
            'summary' => 'Daily adaptogen gummies',
            'description' => 'Helps you focus with calm energy.',
            'image_url' => 'https://example.com/gummies.jpg',
            'is_active' => true,
        ]);

        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseHas('products', ['name' => 'Calm Focus Gummies']);
    }

    public function test_shop_index_shows_active_products(): void
    {
        $active = Product::factory()->create(['is_active' => true, 'name' => 'Shroom Tonic']);
        $inactive = Product::factory()->create(['is_active' => false, 'name' => 'Secret Item']);

        $this->get(route('shop.index'))
            ->assertSee($active->name)
            ->assertDontSee($inactive->name);
    }
}
