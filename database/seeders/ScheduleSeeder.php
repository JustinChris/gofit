<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schedule::create([
            'schedule_for' => Carbon::now()->toDateTimeString(),
            'finished_on' => Carbon::now()->addMonth()->toDateString(),
            'name' => 'Chest Workout',
            'instructor_id' => 1,
        ]);
    }
}
