<?php

namespace App\Http\Services\Favorite;

use App\Models\Favorite;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FavoriteService
{
    public function getAllMyFavorite()
    {
        return Favorite::where('user_id', '=', Auth::user()->id)->orderBy('id', 'ASC')->paginate(config('app.page')[2]);
    }

    public function find($id)
    {
        return Favorite::where('id', $id)->first();
    }

    public function store($hostel)
    {
        $data['user_id'] = Auth::user()->id;
        $data['hostel_id'] = $hostel->id;

        try {
            Favorite::create($data);
            Session::flash('success','Thêm theo dõi thành công');
        } catch (\Exception $err){
            Session::flash('error','Thêm theo dõi thất bại');
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
