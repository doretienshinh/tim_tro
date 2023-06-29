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
        'address_detail',
        'price',
        'payment_note',
        'deposit_price',
        'electricity_price',
        'water_price',
        'water_note',
        'internet_price',
        'internet_note',
        'acreage',
        'air_conditional',
        'heater',
        'washing_machine',
        'stay_with_host',
        'closed_room',
        'parking_area',
        'floor',
        'elevator',
        'kitchen',
        'balcony',
        'amount_of_people',
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

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
