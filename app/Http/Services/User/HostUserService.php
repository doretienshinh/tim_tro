<?php

namespace App\Http\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HostUserService
{
    public function find($id)
    {
        return User::where('id', $id)->first();
    }

    public function update($data)
    {
        $user = Auth::user();

        if (isset($data['avatar'])) {
            if($user->avatar) Storage::delete($user->avatar);
            $urlName = Carbon::now()->format('Y-m-d-H-i-s') . $data['avatar']->getClientOriginalName();;
            $pathUrl = Storage::disk('public')->put('avatar/' . $urlName, file_get_contents($data['avatar']->getRealPath()));
            $data['avatar'] = 'avatar/' . $urlName;
        } 
        if (isset($data['student_card'])) {
            if($user->student_card) Storage::delete($user->student_card);
            $urlName = Carbon::now()->format('Y-m-d-H-i-s') . $data['student_card']->getClientOriginalName();;
            $pathUrl = Storage::disk('public')->put('student_card/' . $urlName, file_get_contents($data['student_card']->getRealPath()));
            $data['student_card'] = 'student_card/' . $urlName;
        } 
        if (isset($data['citizen_identification'])) {
            if($user->citizen_identification) Storage::delete($user->citizen_identification);
            $urlName = Carbon::now()->format('Y-m-d-H-i-s') . $data['citizen_identification']->getClientOriginalName();;
            $pathUrl = Storage::disk('public')->put('citizen_identification/' . $urlName, file_get_contents($data['citizen_identification']->getRealPath()));
            $data['citizen_identification'] = 'citizen_identification/' . $urlName;
        }

        try {
            $user->fill($data);
            $user->save();
            Session::flash('success','Cập nhật thông tin thành công');
        } catch (\Exception $err){
            Session::flash('error','Cập nhật thông tin thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }
}
