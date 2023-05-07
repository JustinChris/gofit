<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $guarded = 'id';
    protected $table = 'schedule';

    protected $fillable = [
        'schedule_for',
        'finished_on',
        'name',
        'instructor_id',
        'isHoliday',
        'price',
        'bonus'
    ];
}
