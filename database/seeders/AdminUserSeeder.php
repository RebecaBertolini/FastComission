<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;


class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Seller::create([
            'name' => 'Admin',
            'email' => 'rebeca.bertolinii@gmail.com',
            'password' => Hash::make('12345678'),
            'is_admin' => true,
        ]);
    }
}
