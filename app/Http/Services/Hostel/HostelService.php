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
        return Hostel::where('leased', '!=', 1)->orderByDesc('id')->paginate(config('app.page')[2]);
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

    public function search($keyword) {
        $hostels = Hostel::where('title', 'like', '%' . $keyword . '%')
                       ->orWhere('description', 'like', '%' . $keyword . '%')
                       ->get();
        return $hostels->where('leased', '!=', 1);
    }

    public function filter_template($data) {

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

    public function filter($data) {
        $where = [
            ['title', 'like', '%' . $data['keyword'] . '%'],
            ['description', 'like', '%' . $data['keyword'] . '%'],
        ];
        if (isset($data['ward_id'])) {
            array_push($where, ['ward_id', '=', $data['ward_id']]);
        }
        if (isset($data['tag_id'])) {
            array_push($where, ['tag_id', '=', $data['tag_id']]);
        }
        if ($data['min_price']) {
            array_push($where, ['price', '>=',$data['min_price']]);
        }
        if ($data['max_price']) {
            array_push($where, ['price', '<=',$data['max_price']]);
        }
        if ($data['min_acreage']) {
            array_push($where, ['acreage', '>=',$data['min_acreage']]);
        }
        if ($data['max_acreage']) {
            array_push($where, ['acreage', '<=',$data['max_acreage']]);
        }
        if ($data['amount_of_people']) {
            array_push($where, ['amount_of_people', '=', $data['amount_of_people']]);
        }
        if (isset($data['stay_with_host'] ) && $data['stay_with_host'] == 'on') {
            array_push($where, ['stay_with_host', '=', 1]);
        }

        if (isset($data['deposit'] ) && $data['deposit'] == 'on') {
            array_push($where, ['deposit_price', '>', 0]);
        }

        if (isset($data['air_conditional'] ) && $data['air_conditional'] == 'on') {
            array_push($where, ['air_conditional', '=', 1]);
        }

        if (isset($data['heater'] ) && $data['heater'] == 'on') {
            array_push($where, ['heater', '=', 1]);
        }

        if (isset($data['washing_machine'] ) && $data['washing_machine'] == 'on') {
            array_push($where, ['washing_machine', '=', 1]);
        }

        if (isset($data['closed_room'] ) && $data['closed_room'] == 'on') {
            array_push($where, ['closed_room', '=', 1]);
        }
        if (isset($data['parking_area'] ) && $data['parking_area'] == 'on') {
            array_push($where, ['parking_area', '=', 1]);
        }
        if (isset($data['elevator'] ) && $data['elevator'] == 'on') {
            array_push($where, ['elevator', '=', 1]);
        }
        if (isset($data['kitchen'] ) && $data['kitchen'] == 'on') {
            array_push($where, ['kitchen', '=', 1]);
        }
        if (isset($data['balcony'] ) && $data['balcony'] == 'on') {
            array_push($where, ['balcony', '=', 1]);
        }

        $hostels = Hostel::where('leased', '!=', 1)->where($where)->get();

        return $hostels->where('leased', '!=', 1);
    }
}