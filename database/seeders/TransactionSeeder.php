<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::create([
            'deposit' => 500000,
            'title' => 'test',
            'bonus' => 5000,
            'user_id' => 5
        ]);

        Transaction::create([
            'deposit' => 300000,
            'title' => 'test',
            'bonus' => 3000,
            'user_id' => 6
        ]);
    }
}
