<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);

        return [
            'name' => Str::title($name),
            'slug' => Str::slug($name) . '-' . fake()->unique()->lexify('???'),
            'summary' => fake()->sentence(),
            'description' => fake()->paragraph(3),
            'price' => fake()->randomFloat(2, 9, 120),
            'inventory' => fake()->numberBetween(10, 200),
            'image_url' => 'https://picsum.photos/seed/' . fake()->uuid() . '/600/400',
            'is_active' => true,
        ];
    }
}
