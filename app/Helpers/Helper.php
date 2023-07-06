<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class Helper
{
    public static function calTimeNotifi($time)
    {
        $now = Carbon::now();
        // Tính khoảng thời gian giữa hai thời điểm
        $interval = $now->diff($time);

        // Lấy số phút trong khoảng thời gian
        $minutes = $interval->i;
        $hours = $interval->h;
        $days = $interval->d;
        if($days) {
            $time_noti = $days . ' ngày trước';
        }
        else if($hours) {
            $time_noti = $hours . ' giờ ' . $minutes . ' phút trước';
        }
        else {
            $time_noti = $minutes . ' phút trước';
        }

        return $time_noti;
    }
}
