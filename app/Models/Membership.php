<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = 'id';
    protected $table = 'membership';

    protected $fillable = [
        'user_id',
        'subscribed_on',
        'expired_on',
        'price',
    ];
}
