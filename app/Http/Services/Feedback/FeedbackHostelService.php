<?php

namespace App\Http\Services\Feedback;

use App\Models\Feedback_hostel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FeedbackHostelService
{
    public function store($data, $id)
    {
        $data['from_user_id'] = Auth::user()->id;
        $data['hostel_id'] = $id;

        try {
            Feedback_hostel::create($data);
            Session::flash('success','Thêm bình luận thành công');
        } catch (\Exception $err){
            Session::flash('error','Thêm bình luận thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($hostel)
    {
        $favorite = Favorite::where('hostel_id', $hostel->id)->where('user_id', '=', Auth::user()->id)->get();
        try {
            $favorite->each->delete();
            Session::flash('success','Bỏ theo dõi thành công');
        } catch (\Exception $err){
            Session::flash('error','Bỏ theo dõi thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }
}
