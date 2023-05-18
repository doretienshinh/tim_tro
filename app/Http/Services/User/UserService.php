<?php

namespace App\Http\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserService
{
    public function getAll()
    {
        return User::orderByDesc('id')->paginate(config('app.page')[2]);
    }
}
