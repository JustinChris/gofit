<?php

namespace App\Http\Controllers;

use App\Models\DailySchedule;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function getAddSchedule(Request $request) {

        $schedule = [];

        if (request('search')) {
            $schedule = Schedule::where('instructor_id','=', request('search'))->get();
        }

        return view('schedule.addSchedule', [
            'user' => Auth::user(),
            'instructors' => User::where(['role' => 'instructor'])->get(),
            'schedule' => $schedule,
        ]);
    }

    public function postAddSchedule(Request $request) {
        $request->validate([
            'name' => 'required',
            'instructor' => 'required',
            'start' => 'required',
            'ends' => 'required',
        ]);

        $conflict = Schedule::where(['schedule_for' => $request->start, 'instructor_id' => $request->instructor])->first();

        if ($conflict) {
            return redirect('/schedule/add')->withErrors('Schedule Conflicted');
        }

        Schedule::create([
            'schedule_for' => $request->start,
            'finished_on' => $request->ends,
            'name' => $request->name,
            'instructor_id' => $request->instructor,
            'isHoliday' => false,
        ]);
        return redirect('/schedule/add');
    }

    public function getDeleteSchedule($id) {
        $schedule = Schedule::where(['id' => $id])->first();
        $schedule->delete();

        return redirect('/schedule');
    }

    public function getUpdateSchedule($id) {

        $schedule = DB::table('schedule')
                    ->join('users', 'instructor_id', '=', 'users.id')
                    ->where(['schedule.id' => $id])
                    ->select(['schedule.id','schedule_for','finished_on','name','isHoliday','instructor_id','username'])
                    ->first();
        $instructorSchedule = [];

        if (request('search')) {
            $instructorSchedule = Schedule::where('instructor_id','=', request('search'))->get();
        }
        return view('schedule.editSchedule', [
            'instructorSchedule' => $instructorSchedule,
            'schedule' => $schedule,
            'user' => Auth::user(),
            'instructors' => User::where(['role' => 'instructor'])->get(),
        ]);
    }

    public function postUpdateSchedule(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'instructor' => 'required',
            'start' => 'required',
            'ends' => 'required',
        ]);

        $conflict = Schedule::where(['schedule_for' => $request->start, 'instructor_id' => $request->instructor])->first();

        if ($conflict) {
            return redirect('/schedule/update/' . $id)->withErrors('Schedule Conflicted');
        }

        $schedule = Schedule::where(['id' => $id])->first();

        $schedule->schedule_for = $request->start;
        $schedule->finished_on = $request->ends;
        $schedule->name = $request->name;
        $schedule->instructor_id = $request->instructor;
        $schedule->save();

        return redirect('/schedule/update/' . $id);
    }

    public function getGenerateDailySchedule() {
        DailySchedule::truncate();

        $now = Carbon::now()->getDaysFromStartOfWeek();
        $firstdayofweek = Carbon::now()->subDays($now-1)->toDateString();
        $lastdayofweek = Carbon::now()->addDays(7-$now)->toDateString();
        
        $schedules = Schedule::whereBetween('schedule_for', [$firstdayofweek, $lastdayofweek])->get();
        
        foreach($schedules as $schedule) {
            DailySchedule::create([
                'schedule_for' => $schedule->schedule_for,
                'finished_on' => $schedule->finished_on,
                'name' => $schedule->name,
                'instructor_id' => $schedule->instructor_id,
                'isHoliday' =>$schedule->isHoliday,
            ]);
        }
    }

    public function getChangeScheduleToHoliday($id) {

        $schedule = Schedule::where(['id' => $id])->first();

        $schedule->isHoliday = true;
        $schedule->save();

        return redirect('/schedule/update/' . $id);
    }

}
