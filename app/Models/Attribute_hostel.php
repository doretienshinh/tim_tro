<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute_hostel extends Model
{
    use HasFactory;

    protected $fillable = [
        'hostel_id',
        'attribute_id',
        'value',
    ];
}
