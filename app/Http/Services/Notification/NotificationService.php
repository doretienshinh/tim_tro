<?php

namespace App\Http\Services\Notification;

use App\Models\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class NotificationService
{
    public function getAll()
    {
        return Notification::orderByDesc('id')->paginate(config('app.page')[2]);
    }

    public function find($id)
    {
        return Notification::where('id', $id)->first();
    }

    public function store($data)
    {
        
    }

    public function update($id, $data)
    {
       
    }
}
