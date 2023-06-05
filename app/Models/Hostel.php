<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'thumbnail',
        'tag_id',
        'user_id',
        'ward_id',
    ];
    
}
