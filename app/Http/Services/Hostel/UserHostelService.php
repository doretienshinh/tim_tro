<?php

namespace App\Http\Services\Hostel;

use App\Models\Hostel;
use App\Models\Hostel_user;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserHostelService
{
    public function getCurrentRegister()
    {
        $register = Hostel_user::where('user_id', '=', Auth::user()->id)->first();

        if($register)
        {
            return $register;
        }
        else return false;
    }

    public function getAll()
    {
        return Hostel::where('user_id', '=', Auth::user()->id)->orderByDesc('id')->paginate(config('app.page')[2]);
    }

    public function find($id)
    {
        return Hostel::where('id', $id)->first();
    }

    public function register($hostel)
    {
        $data['user_id'] = Auth::user()->id;
        $data['hostel_id'] = $hostel->id;
        $data['in_at'] = null;
        $data['out_at'] = null;

        $disableRegister = $this->getCurrentRegister();

        if($disableRegister) {
            Session::flash('warning','Bạn đã gửi yêu cầu tới trọ khác');
            return false;
        }

        try {
            Hostel_user::create($data);
            Session::flash('success','Đã gửi yêu cầu tới chủ trọ');
        } catch (\Exception $err){
            Session::flash('error','Gửi yêu cầu tới chủ trọ thất bại');
            \Log::info($err->getMessage());
            dd($err->getMessage());
            return false;
        }
        return true;
    }
}
