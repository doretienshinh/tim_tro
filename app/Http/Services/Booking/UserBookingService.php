<?php

namespace App\Http\Services\Booking;

use App\Models\Booking;
use App\Models\Time;
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

        $time = Time::where('id', $time_id)->first();

        if($time->weekly_at != null)
        {
            if($time->weekly_at == 'Chủ nhật') {
                $weekly_at = 0;
            }
            else {
                $weekly_at = preg_split("/[\s,]+/", $time->weekly_at)[1]; 
            }
    
            $now = Carbon::now();
            $currentDayOfWeek = $now->format('w'); // Lấy thứ hiện tại (0 - 6)
    
            $nextDesiredDay = null;
            $daysUntilDesiredDay = ($weekly_at - $currentDayOfWeek + 7) % 7;
                
                if ($daysUntilDesiredDay >= 0) {
                    $nextDesiredDay = clone $now;
                    $nextDesiredDay->modify("+$daysUntilDesiredDay days");
                }
    
            if ($nextDesiredDay !== null) {
                $meet_at = $nextDesiredDay->format('Y-m-d');
            }
        }

        else $meet_at = $time->day;
        
        $data['meet_at'] = $meet_at;

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

    public function getAll()
    {
        $bookings = Booking::where('user_id', '=', Auth::user()->id)->where('status', '!=', 'met')->get();

        return $bookings;
    }

    public function delete($booking)
    {
        try {
            $booking->delete();
            Session::flash('success','Xóa lịch xem phòng trọ thành công');
        } catch (\Exception $err){
            Session::flash('error','Xóa lịch xem phòng trọ thành công');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }
}
