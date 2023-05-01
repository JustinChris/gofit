<?php

namespace App\Http\Controllers;

use App\Models\DailySchedule;
use App\Models\Membership;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home () {
        
        return view('home', []);
    }

    public function getDashboard() {

        // daily schedule
        $now = Carbon::now()->getDaysFromStartOfWeek();
        $firstdayofweek = Carbon::now()->subDays($now-1);
        $lastdayofweek = Carbon::now()->addDays(7-$now);

        $schedule = [
            $firstdayofweek->toDateString() => DailySchedule::whereDate('schedule_for','=', $firstdayofweek->toDateString())->get(), //senin
            $firstdayofweek->addDays(1)->toDateString() => DailySchedule::whereDate('schedule_for','=', $firstdayofweek->toDateString())->get(), //selasa
            $firstdayofweek->addDays(2)->subDays(1)->toDateString() => DailySchedule::whereDate('schedule_for','=', $firstdayofweek->toDateString())->get(), //rabu
            $firstdayofweek->addDays(3)->subDays(2)->toDateString() => DailySchedule::whereDate('schedule_for','=', $firstdayofweek->toDateString())->get(), //kamis
            $firstdayofweek->addDays(4)->subDays(3)->toDateString() => DailySchedule::whereDate('schedule_for','=', $firstdayofweek->toDateString())->get(), //jumat
            $firstdayofweek->addDays(5)->subDays(4)->toDateString() => DailySchedule::whereDate('schedule_for','=', $firstdayofweek->toDateString())->get(), //sabtu
            $lastdayofweek->toDateString() => DailySchedule::whereDate('schedule_for','=', $lastdayofweek->toDateString())->get(), //minggu
        ];

        // dd(array_keys($schedule));

        return view('dashboard', [
            'user' => Auth::user(),
            'schedules' => $schedule,
        ]);
    }

    public function getInstructors(Request $request) {
        $instructor = User::where(['role' => 'instructor'])->get();
        if (request('search')) {
            $instructor = User::where('username','like','%' . request('search') . '%')
                            ->where('role', 'like', 'instructor')->get();
        }

        return view('instructors', [
            'user' => Auth::user(),
            'instructors' => $instructor,
        ]);
    }

    public function getMembers() {
        $members = User::where(['role' => 'member'])->get();
        if (request('search')) {
            $members = User::where('username','like','%' . request('search') . '%')
                            ->where('role', 'like', 'member')->get();
        }
        $membership = Membership::get();

        return view('members', [
            'user' => Auth::user(),
            'members' => $members,
            'memberships' => $membership,
        ]);
    }

    public function getSchedule() {
        return view('schedule', [
            'user' =>Auth::user(),
            'schedule' => Schedule::get(),
            'instructors' => User::where(['role' => 'instructor'])->get(),
        ]);
    }

}
