<?php

namespace Database\Factories;

use App\Models\Authorization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AuthorizationFactory extends Factory
{
    protected $model = Authorization::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'provider' => fake()->randomElement(['local', 'github', 'google']),
            'token' => Str::random(40),
            'last_used_at' => fake()->optional()->dateTime(),
            'scopes' => ['read', 'write'],
        ];
    }
}
