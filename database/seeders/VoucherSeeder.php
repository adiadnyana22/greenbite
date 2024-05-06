<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Voucher::create([
            'name' => 'Diskon hari Lebaran',
            'description' => 'Diskon 10% s/d 20k (minimum order 50k)',
            'percentage' => 10,
            'max_nominal' => 20000,
            'min_order_nominal' => 50000,
        ]);

        Voucher::create([
            'name' => 'Diskon Bukber',
            'description' => 'Diskon 25% s/d 50k (minimum order 150k)',
            'percentage' => 25,
            'max_nominal' => 50000,
            'min_order_nominal' => 150000,
        ]);
    }
}
