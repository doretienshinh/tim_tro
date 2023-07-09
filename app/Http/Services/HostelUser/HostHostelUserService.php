<?php

namespace App\Http\Services\HostelUser;

use App\Models\Hostel_user;
use App\Models\Hostel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HostHostelUserService
{
    public function getAllHostel()
    {
        return Hostel::where('user_id', '=', Auth::user()->id)->orderByDesc('id')->paginate(config('app.page')[2]);
    }

    public function find($id)
    {
        return Hostel_user::where('id', '=', $id)->first();
    }

    public function store($data)
    {
        
    }

    public function update($data, $Hostel_user)
    {
        $hostel = Hostel::where('id', '=', $Hostel_user->hostel_id)->first();

        if(isset($data['status']) && $data['status'] == 'accept') {
            $data['in_at'] = Carbon::now();
        }
        else {
            $data['in_at'] = null;
            $hostel->leased = false;
        }

        
        try {
            $Hostel_user->fill($data);
            $Hostel_user->save();
            $hostel->save();
            Session::flash('success','Xét duyệt thành công');
        } catch (\Exception $err){
            Session::flash('error','Xét duyệt thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($hostel){
       
    }
}