<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Food::create([
            'name' => '3 Random Donuts',
            'stock' => 2,
            'min_qty' => 3,
            'max_qty' => 3,
            'day_to_expiration' => 1,
            'start_pickup' => '18:00:00',
            'end_pickup' => '20:00:00',
            'rating' => 0,
            'order_count' => 0,
            'normal_price' => 20000,
            'current_price' => 10000,
            'mitra_id' => 1,
            'food_category_id' => 1,
        ]);

        Food::create([
            'name' => 'Bread/Danish',
            'stock' => 4,
            'min_qty' => 2,
            'max_qty' => 4,
            'day_to_expiration' => 0,
            'start_pickup' => '16:00:00',
            'end_pickup' => '18:00:00',
            'rating' => 0,
            'order_count' => 0,
            'normal_price' => 50000,
            'current_price' => 25000,
            'mitra_id' => 2,
            'food_category_id' => 1,
        ]);

        Food::create([
            'name' => '5 Random Donuts',
            'stock' => 3,
            'min_qty' => 3,
            'max_qty' => 3,
            'day_to_expiration' => 1,
            'start_pickup' => '18:00:00',
            'end_pickup' => '20:00:00',
            'rating' => 0,
            'order_count' => 0,
            'normal_price' => 25000,
            'current_price' => 12500,
            'mitra_id' => 3,
            'food_category_id' => 1,
        ]);
    }
}
