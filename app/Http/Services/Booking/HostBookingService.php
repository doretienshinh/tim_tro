<?php

namespace App\Http\Services\Booking;

use App\Models\Booking;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class HostBookingService
{
    public function getAll()
    {
        return Booking::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'ASC')->paginate(config('app.page')[1]);
    }

    public function update($data, $booking)
    {
        try {
            $booking->fill($data);
            $booking->save();
            Session::flash('success','Đặt lịch thành công');
        } catch (\Exception $err){
            Session::flash('error','Đặt lịch thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }
}
