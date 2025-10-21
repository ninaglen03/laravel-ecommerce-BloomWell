<?php

namespace Database\Factories;

use App\Models\Registration;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegistrationFactory extends Factory
{
    protected $model = Registration::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
            'registered_at' => fake()->optional()->dateTime(),
            'data' => [
                'ip' => fake()->ipv4(),
                'agent' => fake()->userAgent(),
            ],
        ];
    }
}
