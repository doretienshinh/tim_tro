<?php

namespace App\Http\Services\Hostel;

use App\Models\Hostel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HostelService
{
    public function getAll()
    {
        return Hostel::orderByDesc('id')->paginate(config('app.page')[2]);
    }

    public function find($id)
    {
        return Hostel::where('id', $id)->first();
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

    public function search($keyword) {
        return Hostel::where('title', 'like', '%' . $keyword . '%')
                       ->orWhere('description', 'like', '%' . $keyword . '%')
                       ->get();
    }

    public function filter($data) {

        $where = [
            ['title', 'like', '%' . $data['keyword'] . '%'],
            ['description', 'like', '%' . $data['keyword'] . '%'],
        ];
        if ($data['tag'] != "") {
            array_push($where, ['tag_id', '=', $data['tag']]);
        }
        if ($data['priceRange'] == 'higher') {
            array_push($where, ['price', '>=',7000]);
        } else if ($data['priceRange'] == 0) 
        {
            return Hostel::where($where)->get();
        }
        else
        {
            return Hostel::where($where)
                ->whereBetween('price', [intval($data['priceRange']) - 1000 , $data['priceRange']])->get();
        }
        return Hostel::where($where)->get();
    }
}