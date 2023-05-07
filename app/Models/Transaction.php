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
        'deposit',
        'title', 
        'bonus', // bonus in number
        'user_id',
    ];
}
