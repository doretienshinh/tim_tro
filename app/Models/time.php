<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class time extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_at',
        'end_at',
        'note',
        'day',
        'weekly_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
