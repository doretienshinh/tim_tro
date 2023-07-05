<?php

namespace App\Http\Services\Notification;

use App\Models\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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

    public function storeToken()
    {
        $CSRFToken = csrf_token();

        if( Auth::user()->device_key != $CSRFToken)
        {
            try {
                Auth::user()->update(['device_key' => $CSRFToken]);
                Session::flash('success','Lưu token thành công');
            } catch (\Exception $err){
                Session::flash('error','Lưu token thất bại');
                \Log::info($err->getMessage());
                return false;
            }
        }
        return true;
    }
}
