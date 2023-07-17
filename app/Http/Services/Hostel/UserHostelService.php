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
        $status = ['eject', 'accept_leave'];
        $register = Hostel_user::where('user_id', '=', Auth::user()->id)->whereNotIn('status', $status)->first();
        if($register)
        {
            return $register;
        }
        else return false;
    }

    public function findByWardId($id)
    {
        return Hostel::where('ward_id', $id)->orderByDesc('id')->paginate(4);
    }

    public function getAll()
    {
        return Hostel::where('user_id', '=', Auth::user()->id)->orderByDesc('id')->paginate(config('app.page')[1]);
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
        $data['status'] = 'request';

        $disableRegister = $this->getCurrentRegister();

        if($disableRegister) {
            Session::flash('warning','Bạn đã gửi yêu cầu tới trọ khác');
            return false;
        }

        try {
            Hostel_user::create($data);
        } catch (\Exception $err){
            \Log::info($err->getMessage());
            dd($err->getMessage());
            return false;
        }
        return true;
    }

    public function leave()
    {
        $hostel_user = $this->getCurrentRegister();

        $data['status'] = 'request_leave';
        
        try {
            $hostel_user->fill($data);
            $hostel_user->save();
        } catch (\Exception $err){
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }
}
