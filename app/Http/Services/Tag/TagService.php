<?php

namespace App\Http\Services\Tag;

use App\Models\Tag;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class TagService
{
    public function getAll()
    {
        return Tag::orderBy('id', 'ASC')->paginate(config('app.page')[1]);
    }
    
    public function getAllNotHavePagination()
    {
        return Tag::orderBy('id', 'ASC')->get();
    }

    public function find($id)
    {
        return Tag::where('id', $id)->first();
    }

    public function store($data)
    {
        try {
            Tag::create($data);
            Session::flash('success','Thêm thẻ thành công');
        } catch (\Exception $err){
            Session::flash('error','Thêm thẻ thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function update($data, $tag)
    {
        try {
            $tag->fill($data);
            $tag->save();
            Session::flash('success','Sửa thẻ thành công');
        } catch (\Exception $err){
            Session::flash('error','Sửa thẻ thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($tag)
    {
        try {
            $tag->delete();
            Session::flash('success','Xóa thẻ thành công');
        } catch (\Exception $err){
            Session::flash('error','Xóa thẻ thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }
}
