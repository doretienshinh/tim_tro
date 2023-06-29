<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hostel_id',
        'time_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function time()
    {
        return $this->belongsTo(Time::class);
    }

    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }
}
