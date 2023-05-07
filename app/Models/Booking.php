<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = 'id';
    protected $table = 'booking';

    protected $fillable = [
        'class_id',
        'user_id',
    ];
}
