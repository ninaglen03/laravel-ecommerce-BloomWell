<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\ProductCatalogSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@bloomwell'],
            [
                'name' => 'Admin User',
                'is_admin' => true,
                'password' => bcrypt('password'),
            ]
        );

        User::factory(5)->create();

        $this->call(ProductCatalogSeeder::class);
    }
}
