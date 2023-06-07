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

    public function hostel_users()
    {
        return $this->hasMany(Hostel_user::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }
}
