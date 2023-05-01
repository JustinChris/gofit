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
            'username' => 'Jowo Dirgantara',
            'email' => 'dirgantara@gmail.com',
            'password' => bcrypt('jowo123'),
            'phone' => '08123456789',
            'address' => 'jl. dirgantara jakarta 123',
            'role' => 'instructor',
        ]);

        User::create([
            'username' => 'Beni Laptem',
            'email' => 'beni@gmail.com',
            'password' => bcrypt('beni123'),
            'phone' => '08123456789',
            'address' => 'jl. beni jakarta 123',
            'role' => 'instructor',
        ]);

        User::create([
            'username' => 'admin123',
            'email' => 'admin123@gmail.com',
            'password' => bcrypt('admin123'),
            'phone' => '00000000000',
            'address' => 'jl. admin jakarta 123',
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'kasir123',
            'email' => 'kasir123@gmail.com',
            'password' => bcrypt('kasir123'),
            'phone' => '123456789',
            'address' => 'jl. kasir jakarta 123',
            'role' => 'kasir',
        ]);

        User::create([
            'username' => 'member dummy123',
            'email' => 'dummy123@gmail.com',
            'password' => bcrypt('dummy123'),
            'phone' => '08123456789',
            'address' => 'jl. dummy jakarta 123',
            'role' => 'member',
        ]);

        User::create([
            'username' => 'member dummy321',
            'email' => 'dummy321@gmail.com',
            'password' => bcrypt('dummy321'),
            'phone' => '08123456789',
            'address' => 'jl. dummy jakarta 321',
            'role' => 'member',
        ]);

        User::create([
            'username' => 'Deni Laptem',
            'email' => 'deni@gmail.com',
            'password' => bcrypt('deni123'),
            'phone' => '08123456789',
            'address' => 'jl. beni jakarta 123',
            'role' => 'mo',
        ]);
    }
}
