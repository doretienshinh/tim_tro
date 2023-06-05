<?php

namespace App\Http\Services\Hostel;

use App\Models\Hostel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class HostelService
{
    public function getAll()
    {
        return Hostel::orderByDesc('id')->paginate(config('app.page')[2]);
    }
}