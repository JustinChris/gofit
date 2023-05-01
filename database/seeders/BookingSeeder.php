<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Booking::create([
            'price' => 30000,
            'user_id' => 5,
            'class_id' => 1
        ]);

        Booking::create([
            'price' => 30000,
            'user_id' => 6,
            'class_id' => 1
        ]);
    }
}
