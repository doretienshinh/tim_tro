<?php

namespace App\Http\Services\Time;

use App\Models\Time;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class HostTimeService
{
    public function getAllMyTime()
    {
        return Time::where('user_id', '=', Auth::user()->id)->orderBy('id', 'ASC')->paginate(config('app.page')[1]);
    }

    public function store($data)
    {
        $data['user_id'] = Auth::user()->id;
        try {
            Time::create($data);
            Session::flash('success','Thêm thời gian thành công');
        } catch (\Exception $err){
            Session::flash('error','Thêm thời gian thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function update($data, $time)
    {
        if(!isset($data['weekly_at']))  $data['weekly_at'] = null;
        if(!isset($data['day']))  $data['day'] = null;
        try {
            $time->fill($data);
            $time->save();
            Session::flash('success','Sửa thời gian thành công');
        } catch (\Exception $err){
            Session::flash('error','Sửa thời gian thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($time)
    {
        try {
            $time->delete();
            Session::flash('success','Xóa thời gian thành công');
        } catch (\Exception $err){
            Session::flash('error','Xóa thời gian thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }
}
