<?php

namespace App\Http\Services\Hostel;

use App\Models\Hostel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HostHostelService
{
    public function getAll()
    {
        return Hostel::where('user_id', '=', Auth::user()->id)->orderByDesc('id')->paginate(config('app.page')[1]);
    }

    public function find($id)
    {
        return Hostel::where('id', $id)->first();
    }

    public function findByWardId($id)
    {
        return Hostel::where('ward_id', $id)->orderByDesc('id')->paginate(4);
    }

    public function store($data)
    {
        if (isset($data['thumbnail'])) {
            $urlName = Carbon::now()->format('Y-m-d-H-i-s') . $data['thumbnail']->getClientOriginalName();;
            $pathUrl = Storage::disk('public')->put('thumbnail/' . $urlName, file_get_contents($data['thumbnail']->getRealPath()));
            $data['thumbnail'] = 'thumbnail/' . $urlName;
        } 

        if (isset($data['image'])) {
            $images = '';
            foreach ($data['image'] as $image) {
                $urlName = Carbon::now()->format('Y-m-d-H-i-s') . $image->getClientOriginalName();;
                $pathUrl = Storage::disk('public')->put('image_of_hostel/' . $urlName, file_get_contents($image->getRealPath()));
                $url_image = 'image_of_hostel/' . $urlName;
                $images = $images . ';' . $url_image;
            }
            $data['image'] = $images;
        } 
        $data['user_id'] = Auth::user()->id;
        try {
            Hostel::create($data);
            Session::flash('success','Thêm bài viết cho thuê trọ thành công');
        } catch (\Exception $err){
            Session::flash('error','Thêm bài viết cho thuê trọ thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function update($data, $hostel)
    {
        if (isset($data['thumbnail'])) {
            $urlName = Carbon::now()->format('Y-m-d-H-i-s') . $data['thumbnail']->getClientOriginalName();;
            $pathUrl = Storage::disk('public')->put('thumbnail/' . $urlName, file_get_contents($data['thumbnail']->getRealPath()));
            $data['thumbnail'] = 'thumbnail/' . $urlName;
        } 
        else $data['thumbnail'] = $hostel->thumbnail;

        if (isset($data['image'])) {
            $images = '';
            foreach ($data['image'] as $image) {
                $urlName = Carbon::now()->format('Y-m-d-H-i-s') . $image->getClientOriginalName();;
                $pathUrl = Storage::disk('public')->put('image_of_hostel/' . $urlName, file_get_contents($image->getRealPath()));
                $url_image = 'image_of_hostel/' . $urlName;
                $images = $images . ';' . $url_image;
            }
            $data['image'] = $images;
        } 
        else $data['image'] = $hostel->image;
        
        $data['user_id'] = Auth::user()->id;

        try {
            $hostel->fill($data);
            $hostel->save();
            Session::flash('success','Sửa bài viết cho thuê trọ thành công');
        } catch (\Exception $err){
            Session::flash('error','Sửa bài viết cho thuê trọ thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($hostel){
        if($hostel){
            return $hostel->delete();
        }
        else return false;
    }
}