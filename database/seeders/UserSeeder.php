<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'adiadnyana22@gmail.com',
            'password' => Hash::make('admin'),
            'name' => 'Adi Adnyana',
            'coin' => 0,
            'role_id' => 1,
        ]);

        User::create([
            'email' => 'mitra1@gmail.com',
            'password' => Hash::make('mitra1'),
            'name' => 'Mitra 1',
            'coin' => 0,
            'role_id' => 2,
        ]);

        User::create([
            'email' => 'mitra2@gmail.com',
            'password' => Hash::make('mitra2'),
            'name' => 'Mitra 2',
            'coin' => 0,
            'role_id' => 2,
        ]);

        User::create([
            'email' => 'mitra3@gmail.com',
            'password' => Hash::make('mitra3'),
            'name' => 'Mitra 3',
            'coin' => 0,
            'role_id' => 2,
        ]);

        User::create([
            'email' => 'cust1@gmail.com',
            'password' => Hash::make('cust1'),
            'name' => 'Customer 1',
            'coin' => 10000,
            'role_id' => 3,
        ]);

        User::create([
            'email' => 'cust2@gmail.com',
            'password' => Hash::make('cust2'),
            'name' => 'Customer 2',
            'coin' => 12000,
            'role_id' => 3,
        ]);
    }
}
