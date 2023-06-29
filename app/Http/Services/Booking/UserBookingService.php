<?php

namespace App\Http\Services\Booking;

use App\Models\Booking;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserBookingService
{
    public function store($time_id, $hostel_id)
    {
        $data['user_id'] = Auth::user()->id;
        $data['time_id'] = $time_id;
        $data['hostel_id'] = $hostel_id;
        $data['status'] = 'confirm';
        try {
            Booking::create($data);
            Session::flash('success','Đã đặt giờ xem với chủ trọ');
        } catch (\Exception $err){
            Session::flash('error','Thêm thời gian thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }
}
