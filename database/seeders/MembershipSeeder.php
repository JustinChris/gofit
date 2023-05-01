<?php

namespace Database\Seeders;

use App\Models\Membership;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Membership::create([
            'user_id' => 5,
            'subscribed_on' => Carbon::now()->toDateString(),
            'expired_on' => Carbon::now()->addMonth()->toDateString(),
            'price' => 300000,
        ]);
    }
}
