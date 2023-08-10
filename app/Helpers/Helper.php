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

    public static function renderTimeWeekly($time)
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
            return $time->weekly_at . ": " . $nextDesiredDay->format('Y-m-d');
        }
    }

    public static function renderTimeDay($time)
    {
        $dayOfWeek = date('w', strtotime($time->day)); // Lấy thứ (0 - 6)
        $daysOfWeekNames = ['Chủ Nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];
        
        return $daysOfWeekNames[$dayOfWeek] . ": " . $time->day;
    }
}
