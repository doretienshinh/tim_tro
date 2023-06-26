<?php

namespace App\Http\Services\Hostel;

use App\Models\Hostel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserHostelService
{
    public function getAll()
    {
        return Hostel::where('user_id', '=', Auth::user()->id)->orderByDesc('id')->paginate(config('app.page')[2]);
    }

    public function find($id)
    {
        return Hostel::where('id', $id)->first();
    }
}