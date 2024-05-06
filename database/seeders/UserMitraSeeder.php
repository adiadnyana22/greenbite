<?php

namespace Database\Seeders;

use App\Models\UserMitra;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserMitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserMitra::create([
            'user_id' => 2,
            'mitra_id' => 1
        ]);

        UserMitra::create([
            'user_id' => 3,
            'mitra_id' => 2
        ]);

        UserMitra::create([
            'user_id' => 4,
            'mitra_id' => 3
        ]);
    }
}
