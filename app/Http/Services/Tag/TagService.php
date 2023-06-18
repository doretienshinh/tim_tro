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
        return Tag::orderBy('id', 'ASC')->paginate(config('app.page')[2]);
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
        
    }

    public function update($id, $data)
    {
       
    }
}
