<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailySchedule extends Model
{
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = 'id';
    protected $table = 'daily_schedule';

    protected $fillable = [
        'schedule_for',
        'finished_on',
        'name',
        'instructor_id',
        'isHoliday',
    ];
}
