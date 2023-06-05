<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat_user extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'user_id',
    ];
}
