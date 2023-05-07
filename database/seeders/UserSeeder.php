<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'Martin',
            'email' => 'martin@gmail.com',
            'password' => bcrypt('martin123'),
            'phone' => '081245623890',
            'address' => 'Jl. Mikita',
            'role' => 'instructor',
            'balance' => 0,
        ]);

        User::create([
            'username' => 'Juven',
            'email' => 'juven@gmail.com',
            'password' => bcrypt('juven123'),
            'phone' => '082198468734',
            'address' => 'Jl. Badak',
            'role' => 'instructor',
            'balance' => 0,
        ]);

        User::create([
            'username' => 'admins',
            'email' => 'admins@gmail.com',
            'password' => bcrypt('admin123'),
            'phone' => '081275847149',
            'address' => 'Jl. Cempedak',
            'role' => 'admin',
            'balance' => 0,
        ]);

        User::create([
            'username' => 'kasir',
            'email' => 'kasir@gmail.com',
            'password' => bcrypt('kasir123'),
            'phone' => '081561846278',
            'address' => 'Jl. Platipus',
            'role' => 'kasir',
            'balance' => 0,
        ]);

        User::create([
            'username' => 'henry',
            'email' => 'henry123@gmail.com',
            'password' => bcrypt('henry123'),
            'phone' => '08123456789',
            'address' => 'Jl. Babarsari',
            'role' => 'member',
            'balance' => 0,
        ]);

        User::create([
            'username' => 'nicho',
            'email' => 'nicho@gmail.com',
            'password' => bcrypt('nicho123'),
            'phone' => '081212216950',
            'address' => 'Jl. Malioboro',
            'role' => 'member',
            'balance' => 100000,
        ]);

        User::create([
            'username' => 'Mani',
            'email' => 'mani@gmail.com',
            'password' => bcrypt('mani123'),
            'phone' => '081245679012',
            'address' => 'Jl. Jalan',
            'role' => 'mo',
            'balance' => 0,
        ]);
    }
}
