<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            FoodCategorySeeder::class,
            MitraSeeder::class,
            FoodSeeder::class,
            CoinSeeder::class,
            VoucherSeeder::class,
            VoucherUseSeeder::class,
            WishlistSeeder::class,
            OrderSeeder::class,
            ReviewSeeder::class,
            UserMitraSeeder::class,
            NewsSeeder::class,
        ]);
    }
}
