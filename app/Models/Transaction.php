<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $primaryKey = 'id';
    protected $guarded = 'id';
    protected $table = 'transaction';

    protected $fillable = [
        'type', // CLS = class, MBR = Member
        'deposit',
        'title', // if type == class: instructor_id-schedule_id-CLS, else if type == member: user_id-membership_id-MBR
    ];
}
