<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback_hostel extends Model
{
    use HasFactory;

    protected $fillable = [
        'hostel_id',
        'from_user_id',
        'content',
        'rate',
    ];

    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }
}
