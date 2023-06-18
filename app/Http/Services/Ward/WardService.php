<?php

namespace App\Http\Services\Ward;

use App\Models\Ward;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class WardService
{
    public function getAll()
    {
        return Ward::orderByDesc('id')->paginate(config('app.page')[2]);
    }

    public function getAllNotHavePagination()
    {
        return Ward::orderBy('id', 'ASC')->get();
    }

    public function find($id)
    {
        return Ward::where('id', $id)->first();
    }

    public function store($data)
    {
        
    }

    public function update($id, $data)
    {
       
    }

    public function findByDistrict($id)
    {
        return Ward::where('district_id', $id)->orderBy('id', 'ASC')->get();
    }
}
