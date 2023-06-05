<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hostel_user extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hostel_id',
        'in_at',
        'out_at',
    ];
}
